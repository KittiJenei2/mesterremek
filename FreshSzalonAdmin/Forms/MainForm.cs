using System;
using System.Data;
using System.Linq;
using System.Net;
using System.Net.Mail;
using System.Windows.Forms;
using MaterialSkin;
using MaterialSkin.Controls;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public partial class MainForm : MaterialForm
    {
        DatabaseManager adatbazis = new DatabaseManager();
        public MainForm()
        {
            InitializeComponent();
            setDesign();

            this.Load += Form1_Load;
        }

        private void setDesign()
        {
            var skinManager = MaterialSkinManager.Instance;
            skinManager.AddFormToManage(this);

            skinManager.Theme = MaterialSkinManager.Themes.DARK;

            skinManager.ColorScheme = new ColorScheme(
                Primary.LightBlue400, Primary.Blue600, Primary.Amber500, Accent.Amber200, TextShade.WHITE);
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            this.Text = "Fresh Szalon admin felület";

            if (adatbazis.TestConnection() == true)
            {
                statisztikakBetoltese();
                dolgozokBetoltese();
                szolgaltatasokBetoltese();
                szuroDolgozokBetoltese();
                foglalasokBetoltese();
                VendegekBetoltese();
                VelemenyekBetoltese();

                VezerlopultRendezese();
                DolgozokFulRendezese();
                SzolgaltatasokFulRendezese();
                naptarFulRendezese();
                VendegekFulRendezese();
                VelemenyekFulRendezese();
            }
        }

        private void materialLabel1_Click(object sender, EventArgs e)
        {

        }

        // --- VEZÉRLŐPULT FÜL DIZÁJN ELRENDEZÉSE KÓDBÓL (2x2 RÁCS - JAVÍTOTT) ---
        private void VezerlopultRendezese()
        {
            Control kartya1 = RegisztraltTagok.Parent;
            Control kartya2 = LegaktivabbDolgozo.Parent;
            Control kartya3 = LegnepszerubbSzolg.Parent;
            Control kartya4 = HetiBevetel.Parent;

            if (kartya1 == null || kartya1 == kartya2) return;

            Control szuloFul = kartya1.Parent;
            if (szuloFul == null) return;

            int padding = 30; // Jó nagy térköz a kártyák között

            // Kiszámoljuk a méreteket: 2 kártya lesz egymás mellett, így hatalmas helyük lesz!
            int elerhetoSzelesseg = szuloFul.ClientSize.Width;
            int kartyaSzelesseg = (elerhetoSzelesseg - (padding * 3)) / 2;
            int kartyaMagassag = 160; // Magasabb kártyák, hogy levegősebb legyen

            // --- Kártyák 2x2-es elhelyezése ---

            // 1. SOR
            kartya1.Size = new System.Drawing.Size(kartyaSzelesseg, kartyaMagassag);
            kartya1.Location = new System.Drawing.Point(padding, padding);

            kartya2.Size = new System.Drawing.Size(kartyaSzelesseg, kartyaMagassag);
            kartya2.Location = new System.Drawing.Point(kartya1.Right + padding, padding);

            // 2. SOR
            kartya3.Size = new System.Drawing.Size(kartyaSzelesseg, kartyaMagassag);
            kartya3.Location = new System.Drawing.Point(padding, kartya1.Bottom + padding);

            kartya4.Size = new System.Drawing.Size(kartyaSzelesseg, kartyaMagassag);
            kartya4.Location = new System.Drawing.Point(kartya3.Right + padding, kartya2.Bottom + padding);

            Control[] kartyak = { kartya1, kartya2, kartya3, kartya4 };

            // --- Szövegek (Labelek) okos formázása minden kártyán ---
            foreach (Control kartya in kartyak)
            {
                kartya.Anchor = AnchorStyles.Top | AnchorStyles.Left; // Fixáljuk a helyüket

                // Összegyűjtjük a kártyán lévő címkéket (Cím és Érték), és fentről lefelé sorbarendezzük őket
                var labelek = kartya.Controls.OfType<Control>()
                                    .Where(c => c is Label || c is MaterialLabel)
                                    .OrderBy(c => c.Top).ToList();

                int yPozicio = 30; // Az első szöveg fentről 30 pixelre kezdődik

                foreach (var elem in labelek)
                {
                    // Erőszakkal kikapcsoljuk a levágást és beállítjuk a teljes szélességet!
                    elem.AutoSize = false;
                    elem.Width = kartyaSzelesseg - 20; // 10-10 pixel margó a szélétől
                    elem.Height = 40; // Legyen elég magas a két soros szöveghez is

                    // Középre tesszük a kártyán
                    elem.Location = new System.Drawing.Point(10, yPozicio);

                    // Sima Label esetén beállítjuk a tökéletes középre zárt szöveget
                    if (elem is Label lbl)
                    {
                        lbl.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
                    }

                    yPozicio += 60; // A következő szöveg (pl. a konkrét adat) 60 pixellel lejjebb kerül
                }
            }
        }
        private void DolgozokFulRendezese()
        {
            Control szuloFul = dgvDolgozok.Parent;
            if (szuloFul == null) return;

            int padding = 20;

            // 1. FELSŐ SOR: Frissítés gomb
            btnFrissites.Location = new System.Drawing.Point(padding, 20);
            btnFrissites.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            // 2. ALSÓ SOR: Három gomb egymás mellett (Új, Szerkesztés, Törlés)
            btnUjDolgozo.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnUjDolgozo.Location = new System.Drawing.Point(padding, szuloFul.ClientSize.Height - btnUjDolgozo.Height - padding);

            btnSzerkesztes.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnSzerkesztes.Location = new System.Drawing.Point(btnUjDolgozo.Right + padding, szuloFul.ClientSize.Height - btnSzerkesztes.Height - padding);

            btnTorles.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnTorles.Location = new System.Drawing.Point(btnSzerkesztes.Right + padding, szuloFul.ClientSize.Height - btnTorles.Height - padding);

            // 3. KÖZÉPSŐ RÉSZ: Táblázat
            dgvDolgozok.Location = new System.Drawing.Point(padding, btnFrissites.Bottom + 20);
            dgvDolgozok.Width = szuloFul.ClientSize.Width - (padding * 2);
            dgvDolgozok.Height = btnUjDolgozo.Top - dgvDolgozok.Top - 20;

            dgvDolgozok.Anchor = AnchorStyles.Top | AnchorStyles.Bottom | AnchorStyles.Left | AnchorStyles.Right;

            dgvDolgozok.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvDolgozok.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            dgvDolgozok.AllowUserToAddRows = false;
            dgvDolgozok.ReadOnly = true;
            dgvDolgozok.BackgroundColor = System.Drawing.Color.White;
        }

        private void SzolgaltatasokFulRendezese()
        {
            Control szuloFul = dgvSzolgaltatasok.Parent;
            if (szuloFul == null) return;

            int padding = 20;

            // 1. FELSŐ SOR: Frissítés gomb
            btnFrissitSzolg.Location = new System.Drawing.Point(padding, 20);
            btnFrissitSzolg.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            // 2. ALSÓ SOR: Három gomb egymás mellett
            btnUjSzolgaltatas.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnUjSzolgaltatas.Location = new System.Drawing.Point(padding, szuloFul.ClientSize.Height - btnUjSzolgaltatas.Height - padding);

            btnSzerkesztSzolg.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnSzerkesztSzolg.Location = new System.Drawing.Point(btnUjSzolgaltatas.Right + padding, szuloFul.ClientSize.Height - btnSzerkesztSzolg.Height - padding);

            btnTorolSzolg.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnTorolSzolg.Location = new System.Drawing.Point(btnSzerkesztSzolg.Right + padding, szuloFul.ClientSize.Height - btnTorolSzolg.Height - padding);

            // 3. KÖZÉPSŐ RÉSZ: Táblázat
            dgvSzolgaltatasok.Location = new System.Drawing.Point(padding, btnFrissitSzolg.Bottom + 20);
            dgvSzolgaltatasok.Width = szuloFul.ClientSize.Width - (padding * 2);
            dgvSzolgaltatasok.Height = btnUjSzolgaltatas.Top - dgvSzolgaltatasok.Top - 20;

            dgvSzolgaltatasok.Anchor = AnchorStyles.Top | AnchorStyles.Bottom | AnchorStyles.Left | AnchorStyles.Right;

            dgvSzolgaltatasok.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvSzolgaltatasok.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            dgvSzolgaltatasok.AllowUserToAddRows = false;
            dgvSzolgaltatasok.ReadOnly = true;
            dgvSzolgaltatasok.BackgroundColor = System.Drawing.Color.White;
        }

        private void naptarFulRendezese()
        {
            Control szuloFul = dgvFoglalasok.Parent;
            if (szuloFul == null) return;

            int padding = 20;
            int topY = 20;

            dtpDatum.Location = new System.Drawing.Point(padding, topY + 12);
            dtpDatum.Width = 200;
            dtpDatum.Anchor = AnchorStyles.Top | AnchorStyles.Left;
            dtpDatum.ShowCheckBox = true;
            dtpDatum.Checked = false;

            cmbDolgozo.Location = new System.Drawing.Point(dtpDatum.Right + padding, topY);
            cmbDolgozo.Width = 250;
            cmbDolgozo.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            btnSzures.Location = new System.Drawing.Point(cmbDolgozo.Right + padding, topY + 6);
            btnSzures.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            btnMindenFoglalas.Location = new System.Drawing.Point(btnSzures.Right + padding, topY + 6);
            btnMindenFoglalas.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            btnFoglalasTorles.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnFoglalasTorles.Location = new System.Drawing.Point(padding, szuloFul.ClientSize.Height - btnFoglalasTorles.Height - padding);

            dgvFoglalasok.Location = new System.Drawing.Point(padding, cmbDolgozo.Bottom + 20);
            dgvFoglalasok.Width = szuloFul.ClientSize.Width - (padding * 2);
            dgvFoglalasok.Height = btnFoglalasTorles.Top - dgvFoglalasok.Top - 20;

            dgvFoglalasok.Anchor = AnchorStyles.Top | AnchorStyles.Bottom | AnchorStyles.Left | AnchorStyles.Right;

            dgvFoglalasok.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvFoglalasok.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            dgvFoglalasok.AllowUserToAddRows = false;
            dgvFoglalasok.ReadOnly = true;
            dgvFoglalasok.BackgroundColor = System.Drawing.Color.White; // Fehér háttér, hogy kiugorjon a sötét témából
        }

        private void VendegekFulRendezese()
        {
            Control szuloFul = dgvVendegek.Parent;
            if (szuloFul == null) return;

            int padding = 20;

            btnFrissitVendegek.Location = new System.Drawing.Point(padding, 20);
            btnFrissitVendegek.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            btnTorolVendeg.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnTorolVendeg.Location = new System.Drawing.Point(padding, szuloFul.ClientSize.Height - btnTorolVendeg.Height - padding);

            btnKorlatozas.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnKorlatozas.Location = new System.Drawing.Point(btnTorolVendeg.Right + padding, szuloFul.ClientSize.Height - btnKorlatozas.Height - padding);

            dgvVendegek.Location = new System.Drawing.Point(padding, btnFrissitVendegek.Bottom + 20);
            dgvVendegek.Width = szuloFul.ClientSize.Width - (padding * 2);
            dgvVendegek.Height = btnTorolVendeg.Top - dgvVendegek.Top - 20;

            dgvVendegek.Anchor = AnchorStyles.Top | AnchorStyles.Bottom | AnchorStyles.Left | AnchorStyles.Right;

            dgvVendegek.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvVendegek.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            dgvVendegek.AllowUserToAddRows = false;
            dgvVendegek.ReadOnly = true;
            dgvVendegek.BackgroundColor = System.Drawing.Color.White;
        }

        private void VelemenyekFulRendezese()
        {
            Control szuloFul = dgvVelemenyek.Parent;
            if (szuloFul == null) return;

            int padding = 20;

            btnFrissitVelemenyek.Location = new System.Drawing.Point(padding, 20);
            btnFrissitVelemenyek.Anchor = AnchorStyles.Top | AnchorStyles.Left;

            btnTorolVelemeny.Anchor = AnchorStyles.Bottom | AnchorStyles.Left;
            btnTorolVelemeny.Location = new System.Drawing.Point(padding, szuloFul.ClientSize.Height - btnTorolVelemeny.Height - padding);

            dgvVelemenyek.Location = new System.Drawing.Point(padding, btnFrissitVelemenyek.Bottom + 20);
            dgvVelemenyek.Width = szuloFul.ClientSize.Width - (padding * 2);
            dgvVelemenyek.Height = btnTorolVelemeny.Top - dgvVelemenyek.Top - 20;

            dgvVelemenyek.Anchor = AnchorStyles.Top | AnchorStyles.Bottom | AnchorStyles.Left | AnchorStyles.Right;

            dgvVelemenyek.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            dgvVelemenyek.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            dgvVelemenyek.AllowUserToAddRows = false;
            dgvVelemenyek.ReadOnly = true;
            dgvVelemenyek.BackgroundColor = System.Drawing.Color.White;
        }

        private void statisztikakBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            //Regisztrált tagok
            MySqlCommand cmd1 = new MySqlCommand("SELECT COUNT(*) FROM felhasznalo", conn);
            RegisztraltTagok.Text = cmd1.ExecuteScalar().ToString() + " fő";

            //Legaktívabb dolgozó
            string aDolgozo = "SELECT d.nev FROM idopontfoglalas i JOIN dolgozo d ON i.dolgozo_id = d.id GROUP BY i.dolgozo_id ORDER BY COUNT(i.id) DESC LIMIT 1";
            MySqlCommand cmd2 = new MySqlCommand(aDolgozo, conn);
            var aktivDolgozo = cmd2.ExecuteScalar();
            LegaktivabbDolgozo.Text = aktivDolgozo != null ? aktivDolgozo.ToString() : "Nincs adat";

            //Legnépszerűbb szolgáltatás
            string aSzolg = "SELECT sz.nev FROM idopontfoglalas i JOIN szolgaltatasok sz ON i.szolgaltatasok_id = sz.id GROUP BY i.szolgaltatasok_id ORDER BY COUNT(i.id) DESC LIMIT 1";
            MySqlCommand cmd3 = new MySqlCommand(aSzolg, conn);
            var nepszeruSzolg = cmd3.ExecuteScalar();
            LegnepszerubbSzolg.Text = nepszeruSzolg != null ? nepszeruSzolg.ToString() : "Nincs adat";

            //Heti várható bevétel
            string aBevetel = "SELECT SUM(sz.ar) FROM idopontfoglalas i JOIN szolgaltatasok sz ON i.szolgaltatasok_id = sz.id WHERE i.datum >= CURDATE() AND i.datum <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
            MySqlCommand cmd4 = new MySqlCommand(aBevetel, conn);
            var bevetel = cmd4.ExecuteScalar();
            if (bevetel != DBNull.Value && bevetel != null)
            {
                HetiBevetel.Text = Convert.ToInt32(bevetel).ToString("N0") + " Ft";
            }
            else
            {
                HetiBevetel.Text = "0 Ft";
            }

            conn.Close();
        }

        private void dolgozokBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = "SELECT id AS 'Azonosító', nev AS 'Név', email AS 'E-mail', telefon AS 'Telefonszám', bio AS 'Bemutatkozás' FROM dolgozo";
            MySqlCommand cmd = new MySqlCommand(query, conn);

            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            DataTable dt = new DataTable();
            adapter.Fill(dt);

            dgvDolgozok.DataSource = dt;
            conn.Close();
        }

        private void szolgaltatasokBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = @"
                SELECT 
                    sz.id AS 'Azonosító', 
                    l.nev AS 'Kategória', 
                    sz.nev AS 'Szolgáltatás neve', 
                    sz.ar AS 'Ár (Ft)', 
                    sz.idotartam AS 'Időtartam (perc)' 
                FROM szolgaltatasok sz
                JOIN lehetosegek l ON sz.lehetosegek_id = l.id
                ORDER BY l.nev, sz.nev"
            ;

            MySqlCommand cmd = new MySqlCommand(query, conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            System.Data.DataTable dt = new System.Data.DataTable();
            adapter.Fill(dt);

            dgvSzolgaltatasok.DataSource = dt;
            conn.Close();
        }

        private void foglalasokBetoltese(string szuroDatum = "", string szuroDolgozoId = "")
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = @"
                SELECT 
                    i.id AS 'Azonosító', 
                    i.datum AS 'Dátum', 
                    i.ido_kezdes AS 'Kezdés', 
                    f.nev AS 'Vendég', 
                    f.telefonszam AS 'Telefon', 
                    d.nev AS 'Szakember', 
                    sz.nev AS 'Szolgáltatás', 
                    st.nev AS 'Státusz'
                FROM idopontfoglalas i
                JOIN felhasznalo f ON i.felhasznalo_id = f.id
                JOIN dolgozo d ON i.dolgozo_id = d.id
                JOIN szolgaltatasok sz ON i.szolgaltatasok_id = sz.id
                JOIN statuszok st ON i.statuszok_id = st.id
                WHERE 1=1 "
            ;

            if (!string.IsNullOrEmpty(szuroDatum))
            {
                query += $"AND i.datum = '{szuroDatum}' ";
            }

            if (!string.IsNullOrEmpty(szuroDolgozoId))
            {
                query += $"AND i.dolgozo_id = '{szuroDolgozoId}'";
            }

            query += " ORDER BY i.datum DESC, i.ido_kezdes DESC";

            MySqlCommand cmd = new MySqlCommand(query, conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            System.Data.DataTable dt = new System.Data.DataTable();
            adapter.Fill(dt);

            dgvFoglalasok.DataSource = dt;
            conn.Close();

        }

        private void szuroDolgozokBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("SELECT id, nev FROM dolgozo", conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            System.Data.DataTable dt = new System.Data.DataTable();
            adapter.Fill(dt);

            DataRow row = dt.NewRow();
            row["id"] = 0;
            row["nev"] = "--- Minden dolgozó ---";
            dt.Rows.InsertAt(row, 0);

            cmbDolgozo.DataSource = dt;
            cmbDolgozo.DisplayMember = "nev";
            cmbDolgozo.ValueMember = "id";

            conn.Close();
        }

        private void VendegekBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = @"
                SELECT 
                    id AS 'Azonosító', 
                    nev AS 'Név', 
                    email AS 'E-mail', 
                    telefonszam AS 'Telefonszám',
                    IF(foglalhat = 1, 'Engedélyezve', 'TILTVA') AS 'Foglalás joga',
                    IF(velemenyt_irhat = 1, 'Engedélyezve', 'TILTVA') AS 'Vélemény joga'
                FROM felhasznalo"
            ;

            MySqlCommand cmd = new MySqlCommand(query, conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            System.Data.DataTable dt = new System.Data.DataTable();
            adapter.Fill(dt);

            dgvVendegek.DataSource = dt;
            conn.Close();
        }

        private void VelemenyekBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = @"
                SELECT 
                    v.id AS Azonosito, 
                    f.nev AS Vendeg, 
                    sz.nev AS Szolgaltatas, 
                    d.nev AS Dolgozo,
                    v.ertekeles AS Ertekeles, 
                    v.velemeny AS Velemeny, 
                    v.created_at AS Datum 
                FROM velemenyek v
                JOIN felhasznalo f ON v.felhasznalo_id = f.id
                JOIN idopontfoglalas i ON v.idopont_id = i.id
                JOIN szolgaltatasok sz ON i.szolgaltatasok_id = sz.id
                JOIN dolgozo d ON i.dolgozo_id = d.id
                ORDER BY v.created_at DESC"
            ;

            MySqlCommand cmd = new MySqlCommand(query, conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            System.Data.DataTable dt = new System.Data.DataTable();
            adapter.Fill(dt);

            dgvVelemenyek.DataSource = dt;
            conn.Close();
        }

        private void btnFrissites_Click(object sender, EventArgs e)
        {
            dolgozokBetoltese();
        }

        private void btnUjDolgozo_Click(object sender, EventArgs e)
        {
            UjDolgozoForm ujAblak = new UjDolgozoForm();
            ujAblak.ShowDialog();
            dolgozokBetoltese();
        }

        private void btnTorles_Click(object sender, EventArgs e)
        {
            if (dgvDolgozok.SelectedRows.Count > 0)
            {
                string dolgozoId = dgvDolgozok.SelectedRows[0].Cells[0].Value.ToString();
                string dolgozoNev = dgvDolgozok.SelectedRows[0].Cells[1].Value.ToString();

                var valasz = MessageBox.Show($"Biztosan törölni szeretnéd {dolgozoNev} szolgáltatót?", "Törlés megerősítése", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);

                if (valasz == DialogResult.Yes)
                {
                    try
                    {
                        MySqlConnection conn = adatbazis.GetConnection();
                        conn.Open();

                        MySqlCommand cmd = new MySqlCommand("DELETE FROM dolgozo WHERE id = @id", conn);
                        cmd.Parameters.AddWithValue("@id", dolgozoId);
                        cmd.ExecuteNonQuery();

                        conn.Close();
                        MessageBox.Show("A dolgozó sikeresen törölve!", "Siker", MessageBoxButtons.OK, MessageBoxIcon.Information);
                        dolgozokBetoltese();
                    }
                    catch (MySqlException)
                    {
                        MessageBox.Show("Ezt a dolgozót nem lehet törölni, mert aktív foglalásai, szolgáltatásai vagy beosztásai vannak a rendszerben!\n\nIlyen esetben az adatbázis megvédi az adatokat a sérüléstől.", "Hiba a törlésnél", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    }
                }
            }
            else
            {
                MessageBox.Show("Kérlek először kattints egy dolgozóra a táblázatban!", "Nincs kiválasztva", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
        }

        private void btnSzerkesztes_Click(object sender, EventArgs e)
        {
            if (dgvDolgozok.SelectedRows.Count > 0)
            {
                int id = Convert.ToInt32(dgvDolgozok.SelectedRows[0].Cells[0].Value);
                string nev = dgvDolgozok.SelectedRows[0].Cells[1].Value.ToString();
                string email = dgvDolgozok.SelectedRows[0].Cells[2].Value.ToString();
                string telefon = dgvDolgozok.SelectedRows[0].Cells[3].Value.ToString();
                string bio = dgvDolgozok.SelectedRows[0].Cells[4].Value.ToString();

                DolgozoSzerkesztoForm szerkesztoAblak = new DolgozoSzerkesztoForm(id, nev, email, telefon, bio);
                szerkesztoAblak.ShowDialog();

                
                dolgozokBetoltese();
            }
            else
            {
                MessageBox.Show("Kérlek válassz ki egy dolgozót a táblázatból a szerkesztéshez!", "Nincs kiválasztva", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
        }

        private void btnTorolSzolg_Click(object sender, EventArgs e)
        {
            if (dgvSzolgaltatasok.SelectedRows.Count > 0)
            {
                string id = dgvSzolgaltatasok.SelectedRows[0].Cells[0].Value.ToString();
                string nev = dgvSzolgaltatasok.SelectedRows[0].Cells[2].Value.ToString();
                var valasz = MessageBox.Show($"Biztosan törölni szeretnéd ezt a szolgáltatást: {nev}?", "Törlés megerősítése", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);

                if (valasz == DialogResult.Yes)
                {
                    try
                    {
                        MySqlConnection conn = adatbazis.GetConnection();
                        conn.Open();

                        MySqlCommand cmd = new MySqlCommand("DELETE FROM szolgaltatasok WHERE id = @id", conn);
                        cmd.Parameters.AddWithValue("@id", id);
                        cmd.ExecuteNonQuery();

                        conn.Close();

                        MessageBox.Show("A szolgáltatás sikeresen törölve lett!");
                        szolgaltatasokBetoltese();
                    }
                    catch
                    {
                        MessageBox.Show("Ezt a szolgáltatást nem lehet törölni, mert már vannak hozzá tartozó foglalások a rendszerben!", "Hiba a törlésnél", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    }
                }
            }
            else
            {
                MessageBox.Show("Kérlek először kattints egy szolgáltatásra a táblázatban!", "Nincs kiválasztva", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
        }

        private void btnUjSzolgaltatas_Click(object sender, EventArgs e)
        {
            UjSzolgaltatasForm ujSzolgAblak = new UjSzolgaltatasForm();
            ujSzolgAblak.ShowDialog();
            szolgaltatasokBetoltese();
        }

        private void btnFrissitSzolg_Click(object sender, EventArgs e)
        {
            szolgaltatasokBetoltese();
        }

        private void btnSzerkesztSzolg_Click(object sender, EventArgs e)
        {
            if (dgvSzolgaltatasok.SelectedRows.Count > 0)
            {
                int id = Convert.ToInt32(dgvSzolgaltatasok.SelectedRows[0].Cells[0].Value);
                string kategoriaNev = dgvSzolgaltatasok.SelectedRows[0].Cells[1].Value.ToString();
                string nev = dgvSzolgaltatasok.SelectedRows[0].Cells[2].Value.ToString();
                string ar = dgvSzolgaltatasok.SelectedRows[0].Cells[3].Value.ToString();
                string idotartam = dgvSzolgaltatasok.SelectedRows[0].Cells[4].Value.ToString();

                SzolgaltatasSzerkesztForm szerkeszto = new SzolgaltatasSzerkesztForm(id, kategoriaNev, nev, ar, idotartam);
                szerkeszto.ShowDialog();

                szolgaltatasokBetoltese();
            }
            else
            {
                MessageBox.Show("Kérlek válassz ki egy szolgáltatást a táblázatból a szerkesztéshez!", "Nincs kiválasztva", MessageBoxButtons.OK, MessageBoxIcon.Information);
            }
        }

        private void btnSzures_Click(object sender, EventArgs e)
        {
            string kivalasztottDatum = dtpDatum.Checked ? dtpDatum.Value.ToString("yyyy-MM-dd") : "";

            string dolgozoId = cmbDolgozo.SelectedValue.ToString() == "0" ? "" : cmbDolgozo.SelectedValue.ToString();

            foglalasokBetoltese(kivalasztottDatum, dolgozoId);
        }

        private void btnMindenFoglalas_Click(object sender, EventArgs e)
        {
            foglalasokBetoltese();
        }

        private void btnFoglalasTorles_Click(object sender, EventArgs e)
        {
            if (dgvFoglalasok.SelectedRows.Count > 0)
            {
                string id = dgvFoglalasok.SelectedRows[0].Cells[0].Value.ToString();
                string datum = dgvFoglalasok.SelectedRows[0].Cells[1].Value.ToString();
                string vendeg = dgvFoglalasok.SelectedRows[0].Cells[3].Value.ToString();
                string szolgaltatas = dgvFoglalasok.SelectedRows[0].Cells[6].Value.ToString(); // A 6. oszlop a szolgáltatás neve

                var valasz = MessageBox.Show($"Biztosan törölni akarod {vendeg} foglalását erre a napra: {datum}?\n\n(A vendég automatikus e-mail értesítést kap a lemondásról!)", "Foglalás törlése", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);

                if (valasz == DialogResult.Yes)
                {
                    MySqlConnection conn = adatbazis.GetConnection();
                    conn.Open();

                    // 1. LEKÉRJÜK AZ E-MAIL CÍMET TÖRLÉS ELŐTT!
                    string cimzettEmail = "";
                    MySqlCommand getEmailCmd = new MySqlCommand("SELECT f.email FROM idopontfoglalas i JOIN felhasznalo f ON i.felhasznalo_id = f.id WHERE i.id = @id", conn);
                    getEmailCmd.Parameters.AddWithValue("@id", id);
                    var result = getEmailCmd.ExecuteScalar();
                    if (result != null)
                    {
                        cimzettEmail = result.ToString();
                    }

                    // 2. TÖRÖLJÜK A FOGLALÁST
                    MySqlCommand cmd = new MySqlCommand("DELETE FROM idopontfoglalas WHERE id = @id", conn);
                    cmd.Parameters.AddWithValue("@id", id);
                    cmd.ExecuteNonQuery();

                    conn.Close();

                    // 3. ELKÜLDJÜK AZ E-MAILT (Ha megvan a címe)
                    if (!string.IsNullOrEmpty(cimzettEmail))
                    {
                        LemondasEmailKuldese(cimzettEmail, vendeg, datum, szolgaltatas);
                    }

                    MessageBox.Show("A foglalás sikeresen törölve lett, és az értesítő e-mail elment!");
                    foglalasokBetoltese();
                }
            }
            else
            {
                MessageBox.Show("Kérlek válassz ki egy foglalást a táblázatból!");
            }
        }

        private void btnFrissitVendegek_Click(object sender, EventArgs e)
        {
            VendegekBetoltese();
        }

        private void btnTorolVendeg_Click(object sender, EventArgs e)
        {
            if (dgvVendegek.SelectedRows.Count > 0)
            {
                string id = dgvVendegek.SelectedRows[0].Cells[0].Value.ToString();
                string nev = dgvVendegek.SelectedRows[0].Cells[1].Value.ToString();

                var valasz = MessageBox.Show($"Biztosan törölni szeretnéd ezt a vendéget: {nev}?\n\nFigyelem: A törlés visszavonhatatlan!", "Vendég törlése", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);

                if (valasz == DialogResult.Yes)
                {
                    try
                    {
                        MySqlConnection conn = adatbazis.GetConnection();
                        conn.Open();

                        MySqlCommand cmd = new MySqlCommand("DELETE FROM felhasznalo WHERE id = @id", conn);
                        cmd.Parameters.AddWithValue("@id", id);
                        cmd.ExecuteNonQuery();

                        conn.Close();

                        MessageBox.Show("A vendég fiókja sikeresen törölve lett.");
                        VendegekBetoltese();
                    }
                    catch (MySqlException)
                    {
                        MessageBox.Show("Ezt a tagot nem lehet törölni, mert aktív vagy korábbi foglalásai vannak a rendszerben!\n\nKérjük, először mondd le a foglalásait a naptár fülön.", "Hiba a törlésnél", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    }
                }
            }
            else
            {
                MessageBox.Show("Kérlek válassz ki egy vendéget a táblázatból!");
            }
        }

        private void btnFrissitVelemenyek_Click(object sender, EventArgs e)
        {
            VelemenyekBetoltese();
        }

        private void btnTorolVelemeny_Click(object sender, EventArgs e)
        {
            if (dgvVelemenyek.SelectedRows.Count > 0)
            {
                string id = dgvVelemenyek.SelectedRows[0].Cells[0].Value.ToString();
                string vendeg = dgvVelemenyek.SelectedRows[0].Cells[1].Value.ToString();

                var valasz = MessageBox.Show($"Biztosan törölni szeretnéd {vendeg} értékelését?", "Vélemény törlése", MessageBoxButtons.YesNo, MessageBoxIcon.Warning);

                if (valasz == DialogResult.Yes)
                {
                    MySqlConnection conn = adatbazis.GetConnection();
                    conn.Open();

                    MySqlCommand cmd = new MySqlCommand("DELETE FROM velemenyek WHERE id = @id", conn);
                    cmd.Parameters.AddWithValue("@id", id);
                    cmd.ExecuteNonQuery();

                    conn.Close();

                    MessageBox.Show("A vélemény sikeresen törölve lett.");
                    VelemenyekBetoltese(); // Lista frissítése
                }
            }
            else
            {
                MessageBox.Show("Kérlek válassz ki egy véleményt a táblázatból!");
            }
        }

        private void btnKorlatozas_Click(object sender, EventArgs e)
        {
            if (dgvVendegek.SelectedRows.Count > 0)
            {
                int id = Convert.ToInt32(dgvVendegek.SelectedRows[0].Cells[0].Value);
                string nev = dgvVendegek.SelectedRows[0].Cells[1].Value.ToString();

                VendegKorlatozasForm beallitoAblak = new VendegKorlatozasForm(id, nev);
                beallitoAblak.ShowDialog();

                VendegekBetoltese();
            }
            else
            {
                MessageBox.Show("Kérlek válassz ki egy vendéget a táblázatból!");
            }
        }

        // --- AUTOMATIKUS E-MAIL KÜLDÉS LEMONDÁSKOR ---
        private void LemondasEmailKuldese(string cimzettEmail, string vendegNev, string datum, string szolgaltatasNev)
        {
            try
            {
                string feladoEmail = "jenei.kitty@gmail.com";
                string jelszo = "ytaikoxkhmpfbdsz";

                // 2. Kapcsolódás a Gmail szerveréhez
                SmtpClient client = new SmtpClient("smtp.gmail.com", 587);
                client.EnableSsl = true; // Biztonságos kapcsolat (kötelező)
                client.UseDefaultCredentials = false;
                client.Credentials = new NetworkCredential(feladoEmail, jelszo);

                // 3. Levél összeállítása
                MailMessage mailMessage = new MailMessage();
                mailMessage.From = new MailAddress(feladoEmail, "Fresh Szalon");
                mailMessage.To.Add(cimzettEmail); // Ide megy a levél
                mailMessage.Subject = "Időpont törlése - Fresh Szalon";

                // HTML formázott szép levél
                mailMessage.IsBodyHtml = true;
                mailMessage.Body = $@"
                    <div style='font-family: Arial, sans-serif; color: #333;'>
                        <h2 style='color: #d97706;'>Kedves {vendegNev}!</h2>
                        <p>Sajnálattal értesítünk, hogy a rendszerünkben rögzített időpontod szalonunk részéről <b>törlésre került</b> (pl. betegség vagy technikai okok miatt).</p>
                        <p><b>A törölt foglalás adatai:</b></p>
                        <ul>
                            <li><b>Szolgáltatás:</b> {szolgaltatasNev}</li>
                            <li><b>Dátum:</b> {datum}</li>
                        </ul>
                        <p>Kérjük, látogass el weboldalunkra, és foglalj egy új, számodra megfelelő időpontot!</p>
                        <p>Megértésedet köszönjük,<br><b>Fresh Szalon Csapata</b></p>
                    </div>";

                // 4. Levél elküldése
                client.Send(mailMessage);
            }
            catch (Exception ex)
            {
                // Ha nincs net, vagy rossz a jelszó, ne omoljon össze a program, csak szóljon!
                MessageBox.Show("A foglalás törölve lett, de az értesítő e-mailt nem sikerült elküldeni.\nHiba oka: " + ex.Message, "E-mail küldési hiba", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
        }
    }
}
