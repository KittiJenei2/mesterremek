namespace FreshSzalonAdmin
{
    partial class VendegKorlatozasForm
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
            this.swVelemeny = new MaterialSkin.Controls.MaterialSwitch();
            this.swFoglalas = new MaterialSkin.Controls.MaterialSwitch();
            this.btnMentes = new MaterialSkin.Controls.MaterialButton();
            this.btnMegse = new MaterialSkin.Controls.MaterialButton();
            this.SuspendLayout();
            // 
            // swVelemeny
            // 
            this.swVelemeny.AutoSize = true;
            this.swVelemeny.Depth = 0;
            this.swVelemeny.Location = new System.Drawing.Point(322, 129);
            this.swVelemeny.Margin = new System.Windows.Forms.Padding(0);
            this.swVelemeny.MouseLocation = new System.Drawing.Point(-1, -1);
            this.swVelemeny.MouseState = MaterialSkin.MouseState.HOVER;
            this.swVelemeny.Name = "swVelemeny";
            this.swVelemeny.Ripple = true;
            this.swVelemeny.Size = new System.Drawing.Size(168, 37);
            this.swVelemeny.TabIndex = 0;
            this.swVelemeny.Text = "Véleményt írhat";
            this.swVelemeny.UseVisualStyleBackColor = true;
            // 
            // swFoglalas
            // 
            this.swFoglalas.AutoSize = true;
            this.swFoglalas.Depth = 0;
            this.swFoglalas.Location = new System.Drawing.Point(317, 180);
            this.swFoglalas.Margin = new System.Windows.Forms.Padding(0);
            this.swFoglalas.MouseLocation = new System.Drawing.Point(-1, -1);
            this.swFoglalas.MouseState = MaterialSkin.MouseState.HOVER;
            this.swFoglalas.Name = "swFoglalas";
            this.swFoglalas.Ripple = true;
            this.swFoglalas.Size = new System.Drawing.Size(194, 37);
            this.swFoglalas.TabIndex = 1;
            this.swFoglalas.Text = "Időpontot foglalhat";
            this.swFoglalas.UseVisualStyleBackColor = true;
            // 
            // btnMentes
            // 
            this.btnMentes.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnMentes.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnMentes.Depth = 0;
            this.btnMentes.HighEmphasis = true;
            this.btnMentes.Icon = null;
            this.btnMentes.Location = new System.Drawing.Point(386, 273);
            this.btnMentes.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnMentes.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnMentes.Name = "btnMentes";
            this.btnMentes.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnMentes.Size = new System.Drawing.Size(79, 36);
            this.btnMentes.TabIndex = 2;
            this.btnMentes.Text = "Mentés";
            this.btnMentes.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnMentes.UseAccentColor = false;
            this.btnMentes.UseVisualStyleBackColor = true;
            this.btnMentes.Click += new System.EventHandler(this.btnMentes_Click);
            // 
            // btnMegse
            // 
            this.btnMegse.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnMegse.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnMegse.Depth = 0;
            this.btnMegse.HighEmphasis = true;
            this.btnMegse.Icon = null;
            this.btnMegse.Location = new System.Drawing.Point(361, 207);
            this.btnMegse.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnMegse.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnMegse.Name = "btnMegse";
            this.btnMegse.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnMegse.Size = new System.Drawing.Size(70, 36);
            this.btnMegse.TabIndex = 3;
            this.btnMegse.Text = "Mégse";
            this.btnMegse.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnMegse.UseAccentColor = false;
            this.btnMegse.UseVisualStyleBackColor = true;
            this.btnMegse.Click += new System.EventHandler(this.btnMegse_Click);
            // 
            // VendegKorlatozasForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(800, 450);
            this.Controls.Add(this.btnMegse);
            this.Controls.Add(this.btnMentes);
            this.Controls.Add(this.swFoglalas);
            this.Controls.Add(this.swVelemeny);
            this.Name = "VendegKorlatozasForm";
            this.Text = "VendegKorlatozasForm";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private MaterialSkin.Controls.MaterialSwitch swVelemeny;
        private MaterialSkin.Controls.MaterialSwitch swFoglalas;
        private MaterialSkin.Controls.MaterialButton btnMentes;
        private MaterialSkin.Controls.MaterialButton btnMegse;
    }
}