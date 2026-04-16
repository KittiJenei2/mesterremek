using System;
using System.Data;
using System.Windows.Forms;
using MaterialSkin;
using MaterialSkin.Controls;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public partial class SzolgaltatasSzerkesztForm : MaterialForm
    {
        DatabaseManager adatbazis = new DatabaseManager();
        int kivalasztottId;
        public SzolgaltatasSzerkesztForm(int id, string kategoriaNev, string nev, string ar, string idotartam)
        {
            InitializeComponent();

            var skinManager = MaterialSkinManager.Instance;
            skinManager.AddFormToManage(this);
            this.Text = "Szolgáltatás szerkesztése";

            kivalasztottId = id;

            kategoriakBetoltese();

            txtNev.Text = nev;
            txtAr.Text = ar;
            txtIdotartam.Text = idotartam;

            cmbKategoria.SelectedIndex = cmbKategoria.FindStringExact(kategoriaNev);
        }

        private void kategoriakBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();
            MySqlCommand cmd = new MySqlCommand("SELECT id, nev FROM lehetosegek", conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            DataTable dt = new DataTable();
            adapter.Fill(dt);

            cmbKategoria.DataSource = dt;
            cmbKategoria.DisplayMember = "nev";
            cmbKategoria.ValueMember = "id";
            conn.Close();
        }

        private void btnMegse_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btnMentes_Click(object sender, EventArgs e)
        {
            if (string.IsNullOrWhiteSpace(txtNev.Text) || string.IsNullOrWhiteSpace(txtAr.Text) || string.IsNullOrWhiteSpace(txtIdotartam.Text))
            {
                MessageBox.Show("Minden mező kitöltése kötelező!");
                return;
            }

            if (!int.TryParse(txtAr.Text, out int ar) || !int.TryParse(txtIdotartam.Text, out int idotartam))
            {
                MessageBox.Show("Az Ár és az Időtartam mezőkbe csak számokat írhatsz!");
                return;
            }

            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = "UPDATE szolgaltatasok SET lehetosegek_id=@kat_id, nev=@nev, ar=@ar, idotartam=@ido WHERE id=@id";
            MySqlCommand cmd = new MySqlCommand(query, conn);

            cmd.Parameters.AddWithValue("@kat_id", cmbKategoria.SelectedValue);
            cmd.Parameters.AddWithValue("@nev", txtNev.Text);
            cmd.Parameters.AddWithValue("@ar", ar);
            cmd.Parameters.AddWithValue("@ido", idotartam);
            cmd.Parameters.AddWithValue("@id", kivalasztottId);

            cmd.ExecuteNonQuery();
            conn.Close();

            MessageBox.Show("A szolgáltatás sikeresen frissítve!");
            this.Close();
        }
    }
}
