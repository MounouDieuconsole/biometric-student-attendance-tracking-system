using DPFP;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;
using MySql.Data.MySqlClient;
namespace biometric
{
    public partial class SelectCourse : Form
    {
        private DPFP.Template Template1;

        public SelectCourse()
        {
            InitializeComponent();
            LoadCourseCodes(); // Call the method to load course codes
        }

        public string CourseCode
        {
            get { return txtCourseCode.Text; }
        }

        public string Semester
        {
            get { return comboBoxSemester.SelectedItem.ToString(); }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            verify Vefrm = new verify();
            Vefrm.Verify(Template1);
        }

        // Add this method to load course codes into the combo box
        private void LoadCourseCodes()
        {
            // Create a new MySqlConnection
            string Myconnection = "datasource=localhost;username=root;password=;";
            MySqlConnection Myconn = new MySqlConnection(Myconnection);
            string query = "SELECT course_code FROM bsats.course";

            // Open the connection
            Myconn.Open();

            // Create a new MySqlCommand
            using (MySqlCommand cmd = new MySqlCommand(query, Myconn))
            {
                // Execute the command and get the results
                using (MySqlDataReader reader = cmd.ExecuteReader())
                {
                    // Loop through the results
                    while (reader.Read())
                    {
                        // Add each course_code to the combo box
                        txtCourseCode.Items.Add(reader["course_code"].ToString());
                    }
                }
            }
        }
    }
}
