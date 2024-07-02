using DPFP;
using DPFP.Capture;
using Mysqlx.Expr;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics.Eventing.Reader;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace biometric
{
    public partial class capture : Form, DPFP.Capture.EventHandler
    {
        private DPFP.Capture.Capture Capturer;
        public string regno = "";
        public capture()
        {
            InitializeComponent();
        }

        protected void SetPrompt(string prompt)
        {
            this.Invoke(new Function(delegate ()
            {
                Prompt.Text = prompt;
            }));
        }
        protected void SetStatus(string status)
        {
            this.Invoke(new Function(delegate ()
            {
                StatusLabel.Text = status;
            }));
        }
        private void DrawPicture(Bitmap bitmap)
        {
            this.Invoke(new Function(delegate ()
            {
                fImage.Image = new Bitmap(bitmap, fImage.Size);
            }));
        }

        protected void setfname(string value)
        {
            this.Invoke(new Function(delegate () { 
                fname.Text = value;
            
            }));
        }

        protected virtual void Init()
        {
            try
            {
                Capturer = new DPFP.Capture.Capture();
                if (Capturer != null)
                    Capturer.EventHandler = this;
                else
                    SetPrompt("Can't initiate capture operation");
            } catch
            {
                MessageBox.Show("Can't initiate capture operation");
            }
        }
        //process
        protected virtual void Process(DPFP.Sample Sample)
        {
            DrawPicture(ConvertSampleToBitmap(Sample));
        }
   
        protected Bitmap ConvertSampleToBitmap(DPFP.Sample Sample)
        {
            DPFP.Capture.SampleConversion Convertor = new DPFP.Capture.SampleConversion(); Bitmap bitmap = null;
            Convertor.ConvertToPicture(Sample, ref bitmap);
            return bitmap;
        }

        protected void Start()
        {
            if(Capturer != null)
            {
                try
                {
                    Capturer.StartCapture();
                    SetPrompt("Using the fingerprint reader, Scan your fingerprint");
                }
                catch
                {
                    SetPrompt("Can't initiate capture");
                }
            }
        }

        protected void stop()
        {
            if (Capturer != null)
            {
                try
                {
                    Capturer.StopCapture(); 
                    timer1.Dispose();
                }
                catch
                {
                    SetPrompt("Can't terminate capture");
                }
            }
        }

        protected void Makereport(string message)
        {
            this.Invoke(new Function(delegate ()
            {
                StatusText.AppendText(message + "\r\n");
            }));
        }

        protected DPFP.FeatureSet ExtractFeatures(DPFP.Sample Sample, DPFP.Processing.DataPurpose Purpose)
        {
            DPFP.Processing.FeatureExtraction Extractor= new DPFP.Processing.FeatureExtraction();
            DPFP.Capture.CaptureFeedback feedback = DPFP.Capture.CaptureFeedback.None;
            DPFP.FeatureSet features= new DPFP.FeatureSet();
            Extractor.CreateFeatureSet(Sample,Purpose, ref feedback,ref features);
            if(feedback == DPFP.Capture.CaptureFeedback.Good)
                return features;
            else
                return null;
            }
        


        public void OnComplete(object Capture, string ReaderSerialNumber, DPFP.Sample Sample)
        {
            Makereport("The fingerprint sample was captured");
            SetPrompt("Scan the same finger again.");
            Process(Sample);
        }
        public void OnFingerGone(object Capture, string ReaderSerialNumber)
        {
            Makereport("The finger was removed from the fingerprint scanner");
        }
        public void OnFingerTouch(object Capture, string ReaderSerialNumber)
        {
            Makereport("The fingerprint scanner was touched");
        }

        public void OnReaderConnect(object Capture, string ReaderSerialNumber)
        {
            Makereport("The fingerprint scanner was connected");
        }

        public void OnReaderDisconnect(object Capture, string ReaderSerialNumber)
        {
            Makereport("The fingerprint scanner was disconnected");
        }
        public void OnSampleQuality(object Capture, string ReaderSerialNumber, DPFP.Capture.CaptureFeedback CaptureFeedback)
        {
            if (CaptureFeedback == DPFP.Capture.CaptureFeedback.Good)
                Makereport("The quality of the fingerprint sample is good.");
            else
               Makereport("The quality of the fingerprint sample is poor.");
        }
        private void start_scan_Click(object sender, EventArgs e)
        {
            timer1.Interval= 1000;
            timer1.Start();
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            Start();
        }
        private void capture_FormClosing(object sender, FormClosingEventArgs e)
        {
            stop();
        }
        private void capture_Load(object sender, EventArgs e)
        {
            Init();
        }

        private void fname_TextChanged(object sender, EventArgs e)
        {
            regno = fname.Text;
        }

    }
}
