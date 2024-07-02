using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;


namespace biometric
{
    delegate void Function();
    public partial class main : Form
    {

        private DPFP.Template Template;
        public main()
        {
            InitializeComponent();
        }


        public void OnTemplate(DPFP.Template template)
        {
            this.Invoke( new Function(delegate()
            {
                Template=template;

                if(Template!=null)
                {
                    MessageBox.Show("The fingerprint Template is ready for verification", "Fingerprint Enrollment");
                }else
                {
                    MessageBox.Show("The fingerprint template is not valid. Repeat scanning", "Fingerprint Enrollment");
                }

            }));
        }

        private void main_Load(object sender, EventArgs e)
        {

        }

        private void enrol_btn_Click(object sender, EventArgs e)
        {
            enroll EnFrm=new enroll();
            EnFrm.OnTemplate += this.OnTemplate;
            EnFrm.Show();
        }

       private void verify_btn_Click(object sender, EventArgs e)
        {
            
            // Open the SelectCourse form
            SelectCourse scFrm = new SelectCourse();
            scFrm.Show();
            

        }
    }
}
