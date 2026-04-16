using System;
using System.Windows.Forms;
using MaterialSkin;
using MaterialSkin.Controls;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public partial class DolgozoSzerkesztoForm : MaterialForm
    {
        DatabaseManager adatbazis = new DatabaseManager();
        int kivalasztottId;
        public DolgozoSzerkesztoForm(int id, string nev, string email, string telefon, string bio)
        {
            InitializeComponent();

            var skinManager = MaterialSkinManager.Instance;
            skinManager.AddFormToManage(this);
            this.Text = "Dolgozó szerkesztése";

            kivalasztottId = id;
            txtNev.Text = nev;
            txtEmail.Text = email;
            txtTelefon.Text = telefon;
            txtBio.Text = bio;
        }

        private void DolgozoSzerkesztoForm_Load(object sender, EventArgs e)
        {

        }

        private void btnMegse_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btnMentes_Click(object sender, EventArgs e)
        {
            // Kötelező mezők ellenőrzése
            if (string.IsNullOrWhiteSpace(txtNev.Text) || string.IsNullOrWhiteSpace(txtEmail.Text))
            {
                MessageBox.Show("A Név és E-mail megadása kötelező!");
                return;
            }

            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            // SQL UPDATE parancs
            string query = "UPDATE dolgozo SET nev=@nev, email=@email, telefon=@telefon, bio=@bio WHERE id=@id";
            MySqlCommand cmd = new MySqlCommand(query, conn);

            cmd.Parameters.AddWithValue("@nev", txtNev.Text);
            cmd.Parameters.AddWithValue("@email", txtEmail.Text);
            cmd.Parameters.AddWithValue("@telefon", txtTelefon.Text);
            cmd.Parameters.AddWithValue("@bio", txtBio.Text);
            cmd.Parameters.AddWithValue("@id", kivalasztottId); // A rejtett ID alapján frissít!

            cmd.ExecuteNonQuery();
            conn.Close();

            MessageBox.Show("Adatok sikeresen frissítve!");
            this.Close(); // Ablak bezárása
        }
    }
}
