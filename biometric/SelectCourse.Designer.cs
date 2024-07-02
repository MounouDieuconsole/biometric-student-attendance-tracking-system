namespace biometric
{
    partial class SelectCourse
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
            this.lblCode = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.button1 = new System.Windows.Forms.Button();
            this.comboBoxSemester = new System.Windows.Forms.ComboBox();
            this.txtCourseCode = new System.Windows.Forms.ComboBox();
            this.SuspendLayout();
            // 
            // lblCode
            // 
            this.lblCode.AutoSize = true;
            this.lblCode.Font = new System.Drawing.Font("Segoe UI Variable Small", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lblCode.Location = new System.Drawing.Point(35, 72);
            this.lblCode.Name = "lblCode";
            this.lblCode.Size = new System.Drawing.Size(131, 24);
            this.lblCode.TabIndex = 2;
            this.lblCode.Text = "Course Code  :";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Segoe UI Variable Small", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(35, 179);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(99, 24);
            this.label2.TabIndex = 3;
            this.label2.Text = "Semester :";
            // 
            // button1
            // 
            this.button1.Font = new System.Drawing.Font("Segoe UI Variable Display", 9F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.button1.Location = new System.Drawing.Point(263, 292);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(282, 51);
            this.button1.TabIndex = 4;
            this.button1.Text = "Continue";
            this.button1.UseVisualStyleBackColor = true;
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // comboBoxSemester
            // 
            this.comboBoxSemester.DisplayMember = "1";
            this.comboBoxSemester.FormattingEnabled = true;
            this.comboBoxSemester.Items.AddRange(new object[] {
            "1",
            "2"});
            this.comboBoxSemester.Location = new System.Drawing.Point(263, 179);
            this.comboBoxSemester.Name = "comboBoxSemester";
            this.comboBoxSemester.Size = new System.Drawing.Size(282, 28);
            this.comboBoxSemester.TabIndex = 5;
            // 
            // txtCourseCode
            // 
            this.txtCourseCode.FormattingEnabled = true;
            this.txtCourseCode.Location = new System.Drawing.Point(263, 72);
            this.txtCourseCode.Name = "txtCourseCode";
            this.txtCourseCode.Size = new System.Drawing.Size(282, 28);
            this.txtCourseCode.TabIndex = 6;
            // 
            // SelectCourse
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(9F, 20F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(128)))), ((int)(((byte)(0)))));
            this.ClientSize = new System.Drawing.Size(731, 402);
            this.Controls.Add(this.txtCourseCode);
            this.Controls.Add(this.comboBoxSemester);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.lblCode);
            this.Name = "SelectCourse";
            this.Text = "SelectCourse";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private System.Windows.Forms.Label lblCode;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.ComboBox comboBoxSemester;
        private System.Windows.Forms.ComboBox txtCourseCode;
    }
}