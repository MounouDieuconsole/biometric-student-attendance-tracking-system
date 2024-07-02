namespace biometric
{
    partial class main
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
            this.enrol_btn = new System.Windows.Forms.Button();
            this.verify_btn = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // enrol_btn
            // 
            this.enrol_btn.Font = new System.Drawing.Font("Segoe UI Variable Small", 10F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.enrol_btn.Location = new System.Drawing.Point(12, 568);
            this.enrol_btn.Name = "enrol_btn";
            this.enrol_btn.Size = new System.Drawing.Size(252, 37);
            this.enrol_btn.TabIndex = 0;
            this.enrol_btn.Text = "Enroll";
            this.enrol_btn.UseVisualStyleBackColor = true;
            this.enrol_btn.Click += new System.EventHandler(this.enrol_btn_Click);
            // 
            // verify_btn
            // 
            this.verify_btn.Font = new System.Drawing.Font("Segoe UI Variable Small", 10F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.verify_btn.Location = new System.Drawing.Point(768, 568);
            this.verify_btn.Name = "verify_btn";
            this.verify_btn.Size = new System.Drawing.Size(252, 37);
            this.verify_btn.TabIndex = 1;
            this.verify_btn.Text = "Take Attendance";
            this.verify_btn.UseVisualStyleBackColor = true;
            this.verify_btn.Click += new System.EventHandler(this.verify_btn_Click);
            // 
            // main
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(9F, 20F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(128)))), ((int)(((byte)(0)))));
            this.BackgroundImage = global::biometric.Properties.Resources.cuea_logo1;
            this.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.ClientSize = new System.Drawing.Size(1032, 629);
            this.Controls.Add(this.verify_btn);
            this.Controls.Add(this.enrol_btn);
            this.DoubleBuffered = true;
            this.Name = "main";
            this.Text = "Biometric Student Attendance";
            this.Load += new System.EventHandler(this.main_Load);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button enrol_btn;
        private System.Windows.Forms.Button verify_btn;
    }
}

