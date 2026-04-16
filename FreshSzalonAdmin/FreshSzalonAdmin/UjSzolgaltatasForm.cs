using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MaterialSkin;
using MaterialSkin.Controls;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public partial class UjSzolgaltatasForm : MaterialForm
    {
        DatabaseManager adatbazis = new DatabaseManager();
        public UjSzolgaltatasForm()
        {
            InitializeComponent();

            var skinManager = MaterialSkinManager.Instance;
            skinManager.AddFormToManage(this);
            this.Text = "Új szolgáltatás felvétele";

            kategoriakBetoltese();
        }

        private void kategoriakBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = "SELECT id, nev FROM lehetosegek";
            MySqlCommand cmd = new MySqlCommand(query, conn);
            MySqlDataAdapter adapter = new MySqlDataAdapter(cmd);
            DataTable dt = new DataTable();
            adapter.Fill(dt);

            cmbKategoria.DataSource = dt;
            cmbKategoria.DisplayMember = "nev";
            cmbKategoria.ValueMember = "id";

            conn.Close();
        }

        private void UjSzolgaltatasForm_Load(object sender, EventArgs e)
        {

        }

        private void btnMegse_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btnMentes_Click(object sender, EventArgs e)
        {
            if (string.IsNullOrWhiteSpace(txtNev.Text) || string.IsNullOrWhiteSpace(txtAr.Text) || string.IsNullOrWhiteSpace(txtIdotartam.Text))
            {
                MessageBox.Show("Minden mező kitöltése kötelező!", "Hiányzó adat", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            if (!int.TryParse(txtAr.Text, out int ar) || !int.TryParse(txtIdotartam.Text, out int idotartam))
            {
                MessageBox.Show("Az Ár és az Időtartam mezőkbe csak számokat írhatsz!", "Hibás formátum", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = "INSERT INTO szolgaltatasok (lehetosegek_id, nev, ar, idotartam) VALUES (@kat_id, @nev, @ar, @ido)";
            MySqlCommand cmd = new MySqlCommand(query, conn);

            cmd.Parameters.AddWithValue("@kat_id", cmbKategoria.SelectedValue);
            cmd.Parameters.AddWithValue("@nev", txtNev.Text);
            cmd.Parameters.AddWithValue("@ar", ar);
            cmd.Parameters.AddWithValue("@ido", idotartam);

            cmd.ExecuteNonQuery();
            conn.Close();

            MessageBox.Show("Új szolgáltatás sikeresen elmentve!");
            this.Close();
        
        }
    }
}
