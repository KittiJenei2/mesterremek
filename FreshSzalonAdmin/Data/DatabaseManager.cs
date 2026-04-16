using System;
using System.Configuration;
using System.Windows.Forms;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public class DatabaseManager
    {
        private readonly string connectionString = ConfigurationManager.ConnectionStrings["FreshSzalonDb"].ConnectionString;

        public MySqlConnection GetConnection()
        {
            return new MySqlConnection(connectionString);
        }

        public bool TestConnection()
        {
            try
            {
                using (var conn = GetConnection())
                {
                    conn.Open();
                    return true;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show("Hiba az adatbázis csatlakozásakor:\n" + ex.Message, "Hiba", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return false;
            }
        }
    }
}
