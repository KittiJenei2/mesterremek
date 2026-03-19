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
    public partial class VendegKorlatozasForm : MaterialForm
    {
        DatabaseManager adatbazis = new DatabaseManager();
        int kivalasztottId;
        public VendegKorlatozasForm(int id, string nev)
        {
            InitializeComponent();

            var skinManager = MaterialSkinManager.Instance;
            skinManager.AddFormToManage(this);
            this.Text = $"{nev} jogai";

            kivalasztottId = id;

            AdatokBetoltese();
            AblakElrendezese();
        }

        private void AblakElrendezese()
        {
            this.Width = 400;
            this.Height = 280;
            this.StartPosition = FormStartPosition.CenterParent; 
            this.MaximizeBox = false; 
            this.Sizable = false; 

            int padding = 20;
            int startY = 90; 

            swVelemeny.Location = new System.Drawing.Point(padding, startY);
            swFoglalas.Location = new System.Drawing.Point(padding, startY + 50);

            btnMentes.Location = new System.Drawing.Point(this.Width - btnMentes.Width - padding, this.Height - btnMentes.Height - padding);

            btnMegse.Location = new System.Drawing.Point(btnMentes.Left - btnMegse.Width - 10, btnMentes.Top);

            swVelemeny.Anchor = AnchorStyles.Top | AnchorStyles.Left;
            swFoglalas.Anchor = AnchorStyles.Top | AnchorStyles.Left;
            btnMentes.Anchor = AnchorStyles.Bottom | AnchorStyles.Right;
            btnMegse.Anchor = AnchorStyles.Bottom | AnchorStyles.Right;
        }

        private void AdatokBetoltese()
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("SELECT velemenyt_irhat, foglalhat FROM felhasznalo WHERE id = @id", conn);
            cmd.Parameters.AddWithValue("@id", kivalasztottId);

            using (var reader = cmd.ExecuteReader())
            {
                if (reader.Read())
                {
                    swVelemeny.Checked = Convert.ToInt32(reader["velemenyt_irhat"]) == 1;
                    swFoglalas.Checked = Convert.ToInt32(reader["foglalhat"]) == 1;
                }
            }
            conn.Close();
        }

        private void btnMegse_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btnMentes_Click(object sender, EventArgs e)
        {
            MySqlConnection conn = adatbazis.GetConnection();
            conn.Open();

            MySqlCommand cmd = new MySqlCommand("UPDATE felhasznalo SET velemenyt_irhat = @v, foglalhat = @f WHERE id = @id", conn);
            cmd.Parameters.AddWithValue("@v", swVelemeny.Checked ? 1 : 0);
            cmd.Parameters.AddWithValue("@f", swFoglalas.Checked ? 1 : 0);
            cmd.Parameters.AddWithValue("@id", kivalasztottId);

            cmd.ExecuteNonQuery();
            conn.Close();

            MessageBox.Show("A vendég jogai sikeresen frissítve lettek!");
            this.Close();
        }
    }
}
