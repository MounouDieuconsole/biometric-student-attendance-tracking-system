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
using MySql.Data.MySqlClient;
using System.IO;

namespace biometric
{
    public partial class verify : capture
    {
       


        private DPFP.Template Template;
        private DPFP.Verification.Verification verificator;
        public void Verify(DPFP.Template template)
        {
            Template = template;
            ShowDialog();         
        }
        protected override void Process(Sample Sample)

        {
           

            try
                    {
                        string Myconnection = "datasource=localhost;username=root;password=;";
                        string Query = "SELECT * FROM bsats.enrolled";
                        MySqlConnection Myconn = new MySqlConnection(Myconnection);
                        MySqlCommand Mycommand = new MySqlCommand(Query, Myconn);

                        MySqlDataAdapter MydataAdapter = new MySqlDataAdapter();
                        MydataAdapter.SelectCommand = Mycommand;
                        DataTable dTable = new DataTable();

                        MydataAdapter.Fill(dTable);

                        MySqlDataReader myReader;
                        Myconn.Open();
                        myReader = Mycommand.ExecuteReader();

                        foreach (DataRow row in dTable.Rows)
                        {
                            byte[] _img_ = (byte[])row["fingerprint"];
                            MemoryStream ms = new MemoryStream(_img_);

                            DPFP.Template Template = new DPFP.Template();
                            Template.DeSerialize(ms);

                            base.Process(Sample);

                            DPFP.FeatureSet features = ExtractFeatures(Sample, DPFP.Processing.DataPurpose.Verification);

                            if (features != null)
                            {
                                DPFP.Verification.Verification.Result result = new DPFP.Verification.Verification.Result();
                                verificator.Verify(features, Template, ref result);
                                UpdateStatus(result.FARAchieved);

                                if (result.Verified)
                                {
                                    string name = row["course"].ToString();
                                    Makereport("The fingerprint is verified as : " + row["fname"].ToString());
                                    setfname(row["fname"].ToString());
                                    myReader.Close();

                                    // Fetch the course_codes from the course table
                                    MySqlCommand cmdFetch = new MySqlCommand("SELECT course_code FROM bsats.course WHERE course_title = @name", Myconn);
                                    cmdFetch.Parameters.AddWithValue("@name", row["course"].ToString());
                                    MySqlDataReader reader = cmdFetch.ExecuteReader();

                                    List<string> course_codes = new List<string>();
                                    while (reader.Read())
                                    {
                                        course_codes.Add(reader.GetString(0));
                                    }
                                    reader.Close();

                          
                            SelectCourse scForm = Application.OpenForms.OfType<SelectCourse>().FirstOrDefault();

                            if (scForm == null)
                            {
                                // The form is not open, so create a new instance
                                scForm = new SelectCourse();
                                scForm.Show();
                            }

                            // Now you can access the properties
                            string coursecode = string.Empty;
                            string semester = string.Empty;

                            // Use Invoke to access the controls on the UI thread
                            scForm.Invoke((MethodInvoker)delegate
                            {
                                coursecode = scForm.CourseCode;
                                semester = scForm.Semester;
                            });

                            foreach (string course_code in course_codes)
                                    {
                                        // Insert the verified row into the attendance table
                                        MySqlCommand cmd = new MySqlCommand("INSERT INTO bsats.attendance (fname, semester,reg_no,course_code) VALUES (@fname, @semester,@reg_no, @coursecode)", Myconn);
                                        cmd.Parameters.AddWithValue("@fname", row["fname"].ToString());
                                        cmd.Parameters.AddWithValue("@semester", semester);
                                        cmd.Parameters.AddWithValue("@reg_no", row["reg_no"].ToString());
                                        cmd.Parameters.AddWithValue("@coursecode", coursecode);
                                        cmd.ExecuteNonQuery();
                                    }

                                    Makereport("Attendance was taken successfully");


                                    break;
                                }
                                else
                                {
                                    Makereport("The fingerprint was not verified");
                                    setfname("NO DATA");


                                }
                            }
                        }
                        Myconn.Close();
                    }
                    catch (Exception ex)
                    {
                        MessageBox.Show(ex.Message);
                    }
                }
            
        protected override void Init()
        {
            base.Init();
            base.Text = "Fingerprint Verification";
            verificator = new DPFP.Verification.Verification();
            UpdateStatus(0);
        }
        private void UpdateStatus( int FAR)
        {
            SetStatus(String.Format("False Accept Rate (FAR)={0} ", FAR));
        }
    }
}