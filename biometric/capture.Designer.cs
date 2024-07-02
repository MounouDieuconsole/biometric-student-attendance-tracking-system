using System;

namespace biometric
{
    partial class capture
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.fImage = new System.Windows.Forms.PictureBox();
            this.Prompt = new System.Windows.Forms.TextBox();
            this.StatusText = new System.Windows.Forms.TextBox();
            this.StatusLabel = new System.Windows.Forms.Label();
            this.fname = new System.Windows.Forms.TextBox();
            this.start_scan = new System.Windows.Forms.Button();
            this.timer1 = new System.Windows.Forms.Timer(this.components);
            this.label1 = new System.Windows.Forms.Label();
            ((System.ComponentModel.ISupportInitialize)(this.fImage)).BeginInit();
            this.SuspendLayout();
            // 
            // fImage
            // 
            this.fImage.BackColor = System.Drawing.Color.White;
            this.fImage.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.fImage.Location = new System.Drawing.Point(13, 13);
            this.fImage.Name = "fImage";
            this.fImage.Size = new System.Drawing.Size(316, 342);
            this.fImage.TabIndex = 0;
            this.fImage.TabStop = false;
            // 
            // Prompt
            // 
            this.Prompt.BackColor = System.Drawing.SystemColors.Control;
            this.Prompt.Location = new System.Drawing.Point(409, 47);
            this.Prompt.Name = "Prompt";
            this.Prompt.Size = new System.Drawing.Size(379, 26);
            this.Prompt.TabIndex = 1;
            // 
            // StatusText
            // 
            this.StatusText.Location = new System.Drawing.Point(409, 79);
            this.StatusText.Multiline = true;
            this.StatusText.Name = "StatusText";
            this.StatusText.Size = new System.Drawing.Size(379, 296);
            this.StatusText.TabIndex = 2;
            // 
            // StatusLabel
            // 
            this.StatusLabel.AutoSize = true;
            this.StatusLabel.Location = new System.Drawing.Point(12, 481);
            this.StatusLabel.Name = "StatusLabel";
            this.StatusLabel.Size = new System.Drawing.Size(64, 20);
            this.StatusLabel.TabIndex = 3;
            this.StatusLabel.Text = "[Status]";
            this.StatusLabel.Click += new System.EventHandler(this.StatusLabel_Click);
            // 
            // fname
            // 
            this.fname.Location = new System.Drawing.Point(409, 432);
            this.fname.Name = "fname";
            this.fname.Size = new System.Drawing.Size(379, 26);
            this.fname.TabIndex = 4;
            this.fname.TextChanged += new System.EventHandler(this.fname_TextChanged);
            // 
            // start_scan
            // 
            this.start_scan.Location = new System.Drawing.Point(640, 475);
            this.start_scan.Name = "start_scan";
            this.start_scan.Size = new System.Drawing.Size(148, 33);
            this.start_scan.TabIndex = 5;
            this.start_scan.Text = "start scan";
            this.start_scan.UseVisualStyleBackColor = true;
            this.start_scan.Click += new System.EventHandler(this.start_scan_Click);
            // 
            // timer1
            // 
            this.timer1.Tick += new System.EventHandler(this.timer1_Tick);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(409, 21);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(74, 20);
            this.label1.TabIndex = 6;
            this.label1.Text = "Message";
            // 
            // capture
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(9F, 20F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(128)))), ((int)(((byte)(0)))));
            this.ClientSize = new System.Drawing.Size(835, 527);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.start_scan);
            this.Controls.Add(this.fname);
            this.Controls.Add(this.StatusLabel);
            this.Controls.Add(this.StatusText);
            this.Controls.Add(this.Prompt);
            this.Controls.Add(this.fImage);
            this.Name = "capture";
            this.Text = "capture";
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.capture_FormClosing);
            this.Load += new System.EventHandler(this.capture_Load);
            ((System.ComponentModel.ISupportInitialize)(this.fImage)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        private void StatusLabel_Click(object sender, EventArgs e)
        {
            throw new NotImplementedException();
        }

        #endregion

        private System.Windows.Forms.PictureBox fImage;
        private System.Windows.Forms.TextBox Prompt;
        private System.Windows.Forms.TextBox StatusText;
        private System.Windows.Forms.Label StatusLabel;
        private System.Windows.Forms.TextBox fname;
        private System.Windows.Forms.Button start_scan;
        private System.Windows.Forms.Timer timer1;
        private System.Windows.Forms.Label label1;
    }
}