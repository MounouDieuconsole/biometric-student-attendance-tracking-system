using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Security.Cryptography;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Xml;
using MySql.Data.MySqlClient;

namespace biometric
{
    public partial class enroll : capture
    {

        public delegate void OnTemplateEventHandler(DPFP.Template template);
        public event OnTemplateEventHandler OnTemplate;
        private DPFP.Processing.Enrollment Enroller;
        private List<byte[]> capturedSamples = new List<byte[]>();
        protected override void Init()
        {
            base.Init();
            base.Text = "Fingerprint Enrollment";
            Enroller = new DPFP.Processing.Enrollment();
            UpdateStatus();
        }

        protected override void Process(DPFP.Sample sample)
        {
            base.Process(sample);

            DPFP.FeatureSet features = ExtractFeatures(sample, DPFP.Processing.DataPurpose.Enrollment);

            if (features != null)
                try
                {
                    Makereport("The fingerprit feature set was created");
                    Enroller.AddFeatures(features);
                }
                finally
                {
                    UpdateStatus();

                    switch (Enroller.TemplateStatus)
                    {
                        case DPFP.Processing.Enrollment.Status.Ready:
                            {
                                int count = 0;
                                OnTemplate(Enroller.Template);
                                MemoryStream fingerprintdata = new MemoryStream();
                                Enroller.Template.Serialize(fingerprintdata);
                                fingerprintdata.Position = 0;
                                BinaryReader br = new BinaryReader(fingerprintdata);

                                byte[] bytes = br.ReadBytes((Int32)fingerprintdata.Length);
                                // Hash the fingerprint data
                                string fingerprintHash = GetFingerprintHash(bytes);

                                try
                                {
                                    string Myconnection = "datasource=localhost;username=root;password=;";
                                    MySqlConnection Myconn = new MySqlConnection(Myconnection);
                                    Myconn.Open();

                                    // Check if the fingerprint already exists
                                    string fingerprintQuery = "SELECT * FROM bsats.enrolled WHERE fingerprint_hash = @fingerHash";
                                    MySqlCommand fingerprintCommand = new MySqlCommand(fingerprintQuery, Myconn);
                                    fingerprintCommand.Parameters.AddWithValue("@fingerHash", fingerprintHash);
                                    MySqlDataReader fingerprintReader = fingerprintCommand.ExecuteReader();

                                    if (fingerprintReader.HasRows)
                                    {
                                        MessageBox.Show("This fingerprint is already registered.");
                                        fingerprintReader.Close();
                                        Myconn.Close();

                                    }
                                    else
                                    {
                                        fingerprintReader.Close();
                                        // Check if reg no already exist
                                        string Query = "SELECT * FROM bsats.enrolled WHERE UPPER(reg_no)='" + regno.ToUpper() + "'";
                                        MySqlCommand Mycommand = new MySqlCommand(Query, Myconn);
                                        MySqlDataReader Myreader = Mycommand.ExecuteReader();

                                        while (Myreader.Read())
                                        {
                                            count = count + 1;
                                        }
                                        Makereport("Total member found = " + count);
                                        Myreader.Close();
                                        if (count > 0)
                                        {
                                            MessageBox.Show("The Student you want to enroll is already enrolled");
                                            stop();
                                            Start();
                                        }

                                        else

                                        {
                                            // checking if reg no is valid
                                            Myreader.Close();
                                            string Queryy = "SELECT * FROM bsats.student WHERE UPPER(reg_no)='" + regno.ToUpper() + "'";
                             
                                            MySqlCommand Mycommandd = new MySqlCommand(Queryy, Myconn);
                                            MySqlDataReader Myreaderr = Mycommandd.ExecuteReader();

                                            if (string.IsNullOrEmpty(regno) || !Regex.IsMatch(regno, @"^\d{7}$"))
                                            {
                                                MessageBox.Show("Invalid registration number. Please enter a valid registration number.");
                                            }
                                            else if (!Myreaderr.Read()) // Check if there is no matching row
                                            {
                                                MessageBox.Show("The student with the provided registration number does not exist.");
                                            }
                                            else
                                            {
                                                // Retrieve data from the reader
                                                string name = Myreaderr["student_name"].ToString();
                                                string semester = Myreaderr["semester"].ToString(); 
                                                string course = Myreaderr["course"].ToString();

                                                Myreaderr.Close();
                                                // insert the data in database
                                                string Query1 = "INSERT INTO bsats.enrolled (fname,reg_no,course,semester,fingerprint,fingerprint_hash) VALUES (@name, @regno, @course, @semester, @finger,@fingerHash)";
                                                MySqlCommand Mycommand1 = new MySqlCommand(Query1, Myconn);

                                                Mycommand1.Parameters.AddWithValue("@name", name);
                                                Mycommand1.Parameters.AddWithValue("@regno", regno);
                                                Mycommand1.Parameters.AddWithValue("@course", course);
                                                Mycommand1.Parameters.AddWithValue("@semester", semester);
                                                Mycommand1.Parameters.AddWithValue("@finger", bytes).DbType = DbType.Binary;
                                                Mycommand1.Parameters.AddWithValue("@fingerHash", fingerprintHash);

                                                int rowsAffected = Mycommand1.ExecuteNonQuery();
                                                if (rowsAffected > 0)
                                                {
                                                    MessageBox.Show(regno + " was enrolled successfully", "Enrollment success", MessageBoxButtons.OK, MessageBoxIcon.Information);
                                                }
                                                else
                                                {
                                                    MessageBox.Show("The student is not registered");
                                                    Myreaderr.Close();
                                                }
                                            }
                                            Myconn.Close();
                                        }
                                    }
                                }
                                catch (Exception ex)
                                {
                                    MessageBox.Show("Error:" + ex.Message);
                                }

                                break;
                            }
                        case DPFP.Processing.Enrollment.Status.Failed:
                            {
                                Enroller.Clear();
                                stop();
                                UpdateStatus();
                                OnTemplate(null);
                                Start();
                                break;
                            }
                    }
                }
        }
        private void UpdateStatus()
        {
            SetStatus(string.Format("Fingerprint sample needed:{0}", Enroller.FeaturesNeeded));

        }
        private string GetFingerprintHash(byte[] fingerprintData)
        {
            using (SHA256 sha256 = SHA256.Create())
            {
                byte[] hashBytes = sha256.ComputeHash(fingerprintData);
                StringBuilder sb = new StringBuilder();
                foreach (byte b in hashBytes)
                {
                    sb.Append(b.ToString("x2"));
                }
                return sb.ToString();
            }
        }
    }
}

