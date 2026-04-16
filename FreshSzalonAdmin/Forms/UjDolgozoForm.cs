using System;
using System.Windows.Forms;
using MaterialSkin;
using MaterialSkin.Controls;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public partial class UjDolgozoForm : MaterialForm
    {
        DatabaseManager adatbazis = new DatabaseManager();
        public UjDolgozoForm()
        {
            InitializeComponent();
            this.Text = "Új dolgozó felvétele";

            var skinManager = MaterialSkinManager.Instance;
            skinManager.AddFormToManage(this);
        }

        private void UjDolgozoForm_Load(object sender, EventArgs e)
        {

        }

        private void btnMegse_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btnMentes_Click(object sender, EventArgs e)
        {
            if (string.IsNullOrWhiteSpace(txtNev.Text) || string.IsNullOrWhiteSpace(txtEmail.Text) || string.IsNullOrWhiteSpace(txtJelszo.Text))
            {
                MessageBox.Show("A Név, E-mail és Jelszó megadása kötelező!");
                return;
            }

            string titkositottJelszo = BCrypt.Net.BCrypt.HashPassword(txtJelszo.Text);

            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            string query = "INSERT INTO dolgozo (nev, email, telefon, jelszo, bio, kep) VALUES (@nev, @email, @telefon, @jelszo, @bio, 'default.png')";
            MySqlCommand cmd = new MySqlCommand(query, conn);
            cmd.Parameters.AddWithValue("@nev", txtNev.Text);
            cmd.Parameters.AddWithValue("@email", txtEmail.Text);
            cmd.Parameters.AddWithValue("@telefon", txtTelefon.Text);
            cmd.Parameters.AddWithValue("@jelszo", titkositottJelszo);
            cmd.Parameters.AddWithValue("@bio", txtBio.Text);
            cmd.ExecuteNonQuery();
            conn.Close();

            MessageBox.Show("Sikeresen felvetted az új dolgozót!");
            this.Close();
        }
    }
}
