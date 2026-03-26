using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySqlConnector;

namespace FreshSzalonAdmin
{
    public class DatabaseManager
    {
        private readonly string connectionString = "Server=127.0.0.1;Database=fresh_szalon;Uid=root;Pwd=;";


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
