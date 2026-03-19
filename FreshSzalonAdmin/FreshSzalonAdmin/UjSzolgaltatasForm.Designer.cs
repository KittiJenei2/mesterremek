namespace FreshSzalonAdmin
{
    partial class UjSzolgaltatasForm
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
            this.txtNev = new MaterialSkin.Controls.MaterialTextBox();
            this.txtAr = new MaterialSkin.Controls.MaterialTextBox();
            this.txtIdotartam = new MaterialSkin.Controls.MaterialTextBox();
            this.cmbKategoria = new MaterialSkin.Controls.MaterialComboBox();
            this.btnMentes = new MaterialSkin.Controls.MaterialButton();
            this.btnMegse = new MaterialSkin.Controls.MaterialButton();
            this.SuspendLayout();
            // 
            // txtNev
            // 
            this.txtNev.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.txtNev.AnimateReadOnly = false;
            this.txtNev.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.txtNev.Depth = 0;
            this.txtNev.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.txtNev.Hint = "Szolgáltatás neve";
            this.txtNev.LeadingIcon = null;
            this.txtNev.Location = new System.Drawing.Point(18, 80);
            this.txtNev.MaxLength = 50;
            this.txtNev.MouseState = MaterialSkin.MouseState.OUT;
            this.txtNev.Multiline = false;
            this.txtNev.Name = "txtNev";
            this.txtNev.Size = new System.Drawing.Size(466, 50);
            this.txtNev.TabIndex = 0;
            this.txtNev.Text = "";
            this.txtNev.TrailingIcon = null;
            // 
            // txtAr
            // 
            this.txtAr.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.txtAr.AnimateReadOnly = false;
            this.txtAr.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.txtAr.Depth = 0;
            this.txtAr.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.txtAr.Hint = "Ár (Ft)";
            this.txtAr.LeadingIcon = null;
            this.txtAr.Location = new System.Drawing.Point(18, 136);
            this.txtAr.MaxLength = 50;
            this.txtAr.MouseState = MaterialSkin.MouseState.OUT;
            this.txtAr.Multiline = false;
            this.txtAr.Name = "txtAr";
            this.txtAr.Size = new System.Drawing.Size(466, 50);
            this.txtAr.TabIndex = 1;
            this.txtAr.Text = "";
            this.txtAr.TrailingIcon = null;
            // 
            // txtIdotartam
            // 
            this.txtIdotartam.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.txtIdotartam.AnimateReadOnly = false;
            this.txtIdotartam.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.txtIdotartam.Depth = 0;
            this.txtIdotartam.Font = new System.Drawing.Font("Roboto", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Pixel);
            this.txtIdotartam.Hint = "Időtartam (perc)";
            this.txtIdotartam.LeadingIcon = null;
            this.txtIdotartam.Location = new System.Drawing.Point(18, 192);
            this.txtIdotartam.MaxLength = 50;
            this.txtIdotartam.MouseState = MaterialSkin.MouseState.OUT;
            this.txtIdotartam.Multiline = false;
            this.txtIdotartam.Name = "txtIdotartam";
            this.txtIdotartam.Size = new System.Drawing.Size(466, 50);
            this.txtIdotartam.TabIndex = 2;
            this.txtIdotartam.Text = "";
            this.txtIdotartam.TrailingIcon = null;
            // 
            // cmbKategoria
            // 
            this.cmbKategoria.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.cmbKategoria.AutoResize = false;
            this.cmbKategoria.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.cmbKategoria.Depth = 0;
            this.cmbKategoria.DrawMode = System.Windows.Forms.DrawMode.OwnerDrawVariable;
            this.cmbKategoria.DropDownHeight = 174;
            this.cmbKategoria.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cmbKategoria.DropDownWidth = 121;
            this.cmbKategoria.Font = new System.Drawing.Font("Microsoft Sans Serif", 14F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.cmbKategoria.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.cmbKategoria.FormattingEnabled = true;
            this.cmbKategoria.Hint = "Kategória...";
            this.cmbKategoria.IntegralHeight = false;
            this.cmbKategoria.ItemHeight = 43;
            this.cmbKategoria.Location = new System.Drawing.Point(18, 248);
            this.cmbKategoria.MaxDropDownItems = 4;
            this.cmbKategoria.MouseState = MaterialSkin.MouseState.OUT;
            this.cmbKategoria.Name = "cmbKategoria";
            this.cmbKategoria.Size = new System.Drawing.Size(466, 49);
            this.cmbKategoria.StartIndex = 0;
            this.cmbKategoria.TabIndex = 3;
            // 
            // btnMentes
            // 
            this.btnMentes.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.btnMentes.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnMentes.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnMentes.Depth = 0;
            this.btnMentes.HighEmphasis = true;
            this.btnMentes.Icon = null;
            this.btnMentes.Location = new System.Drawing.Point(328, 306);
            this.btnMentes.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnMentes.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnMentes.Name = "btnMentes";
            this.btnMentes.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnMentes.Size = new System.Drawing.Size(79, 36);
            this.btnMentes.TabIndex = 4;
            this.btnMentes.Text = "Mentés";
            this.btnMentes.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnMentes.UseAccentColor = false;
            this.btnMentes.UseVisualStyleBackColor = true;
            this.btnMentes.Click += new System.EventHandler(this.btnMentes_Click);
            // 
            // btnMegse
            // 
            this.btnMegse.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.btnMegse.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnMegse.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnMegse.Depth = 0;
            this.btnMegse.HighEmphasis = true;
            this.btnMegse.Icon = null;
            this.btnMegse.Location = new System.Drawing.Point(415, 306);
            this.btnMegse.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnMegse.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnMegse.Name = "btnMegse";
            this.btnMegse.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnMegse.Size = new System.Drawing.Size(70, 36);
            this.btnMegse.TabIndex = 5;
            this.btnMegse.Text = "Mégse";
            this.btnMegse.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnMegse.UseAccentColor = false;
            this.btnMegse.UseVisualStyleBackColor = true;
            this.btnMegse.Click += new System.EventHandler(this.btnMegse_Click);
            // 
            // UjSzolgaltatasForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(490, 355);
            this.Controls.Add(this.btnMegse);
            this.Controls.Add(this.btnMentes);
            this.Controls.Add(this.cmbKategoria);
            this.Controls.Add(this.txtIdotartam);
            this.Controls.Add(this.txtAr);
            this.Controls.Add(this.txtNev);
            this.Name = "UjSzolgaltatasForm";
            this.Text = "Új szolgáltatás";
            this.Load += new System.EventHandler(this.UjSzolgaltatasForm_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private MaterialSkin.Controls.MaterialTextBox txtNev;
        private MaterialSkin.Controls.MaterialTextBox txtAr;
        private MaterialSkin.Controls.MaterialTextBox txtIdotartam;
        private MaterialSkin.Controls.MaterialComboBox cmbKategoria;
        private MaterialSkin.Controls.MaterialButton btnMentes;
        private MaterialSkin.Controls.MaterialButton btnMegse;
    }
}