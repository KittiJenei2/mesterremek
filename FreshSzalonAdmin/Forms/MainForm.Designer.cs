namespace FreshSzalonAdmin
{
    partial class MainForm
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
            this.materialTabControl1 = new MaterialSkin.Controls.MaterialTabControl();
            this.tabVezerlopult = new System.Windows.Forms.TabPage();
            this.materialCard4 = new MaterialSkin.Controls.MaterialCard();
            this.RegisztraltTagok = new MaterialSkin.Controls.MaterialLabel();
            this.materialLabel4 = new MaterialSkin.Controls.MaterialLabel();
            this.materialCard3 = new MaterialSkin.Controls.MaterialCard();
            this.LegnepszerubbSzolg = new MaterialSkin.Controls.MaterialLabel();
            this.materialLabel5 = new MaterialSkin.Controls.MaterialLabel();
            this.materialCard2 = new MaterialSkin.Controls.MaterialCard();
            this.HetiBevetel = new MaterialSkin.Controls.MaterialLabel();
            this.materialLabel3 = new MaterialSkin.Controls.MaterialLabel();
            this.materialCard1 = new MaterialSkin.Controls.MaterialCard();
            this.LegaktivabbDolgozo = new MaterialSkin.Controls.MaterialLabel();
            this.materialLabel1 = new MaterialSkin.Controls.MaterialLabel();
            this.tabDolgozok = new System.Windows.Forms.TabPage();
            this.btnTorles = new MaterialSkin.Controls.MaterialButton();
            this.btnSzerkesztes = new MaterialSkin.Controls.MaterialButton();
            this.btnFrissites = new MaterialSkin.Controls.MaterialButton();
            this.btnUjDolgozo = new MaterialSkin.Controls.MaterialButton();
            this.dgvDolgozok = new System.Windows.Forms.DataGridView();
            this.tabKategoriak = new System.Windows.Forms.TabPage();
            this.btnFrissitSzolg = new MaterialSkin.Controls.MaterialButton();
            this.btnTorolSzolg = new MaterialSkin.Controls.MaterialButton();
            this.btnSzerkesztSzolg = new MaterialSkin.Controls.MaterialButton();
            this.btnUjSzolgaltatas = new MaterialSkin.Controls.MaterialButton();
            this.dgvSzolgaltatasok = new System.Windows.Forms.DataGridView();
            this.tabNaptar = new System.Windows.Forms.TabPage();
            this.tabVendegek = new System.Windows.Forms.TabPage();
            this.tabVelemenyek = new System.Windows.Forms.TabPage();
            this.dtpDatum = new System.Windows.Forms.DateTimePicker();
            this.cmbDolgozo = new MaterialSkin.Controls.MaterialComboBox();
            this.btnSzures = new MaterialSkin.Controls.MaterialButton();
            this.btnMindenFoglalas = new MaterialSkin.Controls.MaterialButton();
            this.dgvFoglalasok = new System.Windows.Forms.DataGridView();
            this.btnFoglalasTorles = new MaterialSkin.Controls.MaterialButton();
            this.dgvVendegek = new System.Windows.Forms.DataGridView();
            this.btnTorolVendeg = new MaterialSkin.Controls.MaterialButton();
            this.btnFrissitVendegek = new MaterialSkin.Controls.MaterialButton();
            this.dgvVelemenyek = new System.Windows.Forms.DataGridView();
            this.btnFrissitVelemenyek = new MaterialSkin.Controls.MaterialButton();
            this.btnTorolVelemeny = new MaterialSkin.Controls.MaterialButton();
            this.btnKorlatozas = new MaterialSkin.Controls.MaterialButton();
            this.materialTabControl1.SuspendLayout();
            this.tabVezerlopult.SuspendLayout();
            this.materialCard4.SuspendLayout();
            this.materialCard3.SuspendLayout();
            this.materialCard2.SuspendLayout();
            this.materialCard1.SuspendLayout();
            this.tabDolgozok.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvDolgozok)).BeginInit();
            this.tabKategoriak.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvSzolgaltatasok)).BeginInit();
            this.tabNaptar.SuspendLayout();
            this.tabVendegek.SuspendLayout();
            this.tabVelemenyek.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvFoglalasok)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.dgvVendegek)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.dgvVelemenyek)).BeginInit();
            this.SuspendLayout();
            // 
            // materialTabControl1
            // 
            this.materialTabControl1.Controls.Add(this.tabVezerlopult);
            this.materialTabControl1.Controls.Add(this.tabDolgozok);
            this.materialTabControl1.Controls.Add(this.tabKategoriak);
            this.materialTabControl1.Controls.Add(this.tabNaptar);
            this.materialTabControl1.Controls.Add(this.tabVendegek);
            this.materialTabControl1.Controls.Add(this.tabVelemenyek);
            this.materialTabControl1.Depth = 0;
            this.materialTabControl1.Dock = System.Windows.Forms.DockStyle.Fill;
            this.materialTabControl1.Location = new System.Drawing.Point(3, 64);
            this.materialTabControl1.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialTabControl1.Multiline = true;
            this.materialTabControl1.Name = "materialTabControl1";
            this.materialTabControl1.SelectedIndex = 0;
            this.materialTabControl1.Size = new System.Drawing.Size(897, 733);
            this.materialTabControl1.TabIndex = 0;
            // 
            // tabVezerlopult
            // 
            this.tabVezerlopult.Controls.Add(this.materialCard4);
            this.tabVezerlopult.Controls.Add(this.materialCard3);
            this.tabVezerlopult.Controls.Add(this.materialCard2);
            this.tabVezerlopult.Controls.Add(this.materialCard1);
            this.tabVezerlopult.Location = new System.Drawing.Point(4, 22);
            this.tabVezerlopult.Name = "tabVezerlopult";
            this.tabVezerlopult.Padding = new System.Windows.Forms.Padding(3);
            this.tabVezerlopult.Size = new System.Drawing.Size(1186, 707);
            this.tabVezerlopult.TabIndex = 0;
            this.tabVezerlopult.Text = "Vezérlőpult";
            this.tabVezerlopult.UseVisualStyleBackColor = true;
            // 
            // materialCard4
            // 
            this.materialCard4.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.materialCard4.Controls.Add(this.RegisztraltTagok);
            this.materialCard4.Controls.Add(this.materialLabel4);
            this.materialCard4.Depth = 0;
            this.materialCard4.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.materialCard4.Location = new System.Drawing.Point(523, 360);
            this.materialCard4.Margin = new System.Windows.Forms.Padding(14);
            this.materialCard4.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialCard4.Name = "materialCard4";
            this.materialCard4.Padding = new System.Windows.Forms.Padding(14);
            this.materialCard4.Size = new System.Drawing.Size(339, 194);
            this.materialCard4.TabIndex = 3;
            // 
            // RegisztraltTagok
            // 
            this.RegisztraltTagok.AutoSize = true;
            this.RegisztraltTagok.Depth = 0;
            this.RegisztraltTagok.Font = new System.Drawing.Font("Roboto", 34F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.RegisztraltTagok.FontType = MaterialSkin.MaterialSkinManager.fontType.H4;
            this.RegisztraltTagok.Location = new System.Drawing.Point(90, 73);
            this.RegisztraltTagok.MouseState = MaterialSkin.MouseState.HOVER;
            this.RegisztraltTagok.Name = "RegisztraltTagok";
            this.RegisztraltTagok.Size = new System.Drawing.Size(152, 41);
            this.RegisztraltTagok.TabIndex = 1;
            this.RegisztraltTagok.Text = "Betöltés...";
            // 
            // materialLabel4
            // 
            this.materialLabel4.AutoSize = true;
            this.materialLabel4.Depth = 0;
            this.materialLabel4.Font = new System.Drawing.Font("Roboto Medium", 20F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel4.FontType = MaterialSkin.MaterialSkinManager.fontType.H6;
            this.materialLabel4.Location = new System.Drawing.Point(93, 14);
            this.materialLabel4.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel4.Name = "materialLabel4";
            this.materialLabel4.Size = new System.Drawing.Size(152, 24);
            this.materialLabel4.TabIndex = 0;
            this.materialLabel4.Text = "Regisztrált tagok";
            // 
            // materialCard3
            // 
            this.materialCard3.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.materialCard3.Controls.Add(this.LegnepszerubbSzolg);
            this.materialCard3.Controls.Add(this.materialLabel5);
            this.materialCard3.Depth = 0;
            this.materialCard3.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.materialCard3.Location = new System.Drawing.Point(523, 138);
            this.materialCard3.Margin = new System.Windows.Forms.Padding(14);
            this.materialCard3.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialCard3.Name = "materialCard3";
            this.materialCard3.Padding = new System.Windows.Forms.Padding(14);
            this.materialCard3.Size = new System.Drawing.Size(339, 194);
            this.materialCard3.TabIndex = 2;
            // 
            // LegnepszerubbSzolg
            // 
            this.LegnepszerubbSzolg.AutoSize = true;
            this.LegnepszerubbSzolg.Depth = 0;
            this.LegnepszerubbSzolg.Font = new System.Drawing.Font("Roboto", 34F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.LegnepszerubbSzolg.FontType = MaterialSkin.MaterialSkinManager.fontType.H4;
            this.LegnepszerubbSzolg.Location = new System.Drawing.Point(93, 74);
            this.LegnepszerubbSzolg.MouseState = MaterialSkin.MouseState.HOVER;
            this.LegnepszerubbSzolg.Name = "LegnepszerubbSzolg";
            this.LegnepszerubbSzolg.Size = new System.Drawing.Size(152, 41);
            this.LegnepszerubbSzolg.TabIndex = 1;
            this.LegnepszerubbSzolg.Text = "Betöltés...";
            // 
            // materialLabel5
            // 
            this.materialLabel5.AutoSize = true;
            this.materialLabel5.Depth = 0;
            this.materialLabel5.Font = new System.Drawing.Font("Roboto Medium", 20F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel5.FontType = MaterialSkin.MaterialSkinManager.fontType.H6;
            this.materialLabel5.Location = new System.Drawing.Point(66, 14);
            this.materialLabel5.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel5.Name = "materialLabel5";
            this.materialLabel5.Size = new System.Drawing.Size(196, 24);
            this.materialLabel5.TabIndex = 0;
            this.materialLabel5.Text = "Legnépszerűbb szolg.";
            // 
            // materialCard2
            // 
            this.materialCard2.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.materialCard2.Controls.Add(this.HetiBevetel);
            this.materialCard2.Controls.Add(this.materialLabel3);
            this.materialCard2.Depth = 0;
            this.materialCard2.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.materialCard2.Location = new System.Drawing.Point(156, 360);
            this.materialCard2.Margin = new System.Windows.Forms.Padding(14);
            this.materialCard2.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialCard2.Name = "materialCard2";
            this.materialCard2.Padding = new System.Windows.Forms.Padding(14);
            this.materialCard2.Size = new System.Drawing.Size(339, 194);
            this.materialCard2.TabIndex = 2;
            // 
            // HetiBevetel
            // 
            this.HetiBevetel.AutoSize = true;
            this.HetiBevetel.Depth = 0;
            this.HetiBevetel.Font = new System.Drawing.Font("Roboto", 34F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.HetiBevetel.FontType = MaterialSkin.MaterialSkinManager.fontType.H4;
            this.HetiBevetel.Location = new System.Drawing.Point(63, 73);
            this.HetiBevetel.MouseState = MaterialSkin.MouseState.HOVER;
            this.HetiBevetel.Name = "HetiBevetel";
            this.HetiBevetel.Size = new System.Drawing.Size(152, 41);
            this.HetiBevetel.TabIndex = 1;
            this.HetiBevetel.Text = "Betöltés...";
            // 
            // materialLabel3
            // 
            this.materialLabel3.AutoSize = true;
            this.materialLabel3.Depth = 0;
            this.materialLabel3.Font = new System.Drawing.Font("Roboto Medium", 20F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel3.FontType = MaterialSkin.MaterialSkinManager.fontType.H6;
            this.materialLabel3.Location = new System.Drawing.Point(49, 14);
            this.materialLabel3.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel3.Name = "materialLabel3";
            this.materialLabel3.Size = new System.Drawing.Size(182, 24);
            this.materialLabel3.TabIndex = 0;
            this.materialLabel3.Text = "Heti várható bevétel";
            // 
            // materialCard1
            // 
            this.materialCard1.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.materialCard1.Controls.Add(this.LegaktivabbDolgozo);
            this.materialCard1.Controls.Add(this.materialLabel1);
            this.materialCard1.Depth = 0;
            this.materialCard1.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.materialCard1.Location = new System.Drawing.Point(156, 138);
            this.materialCard1.Margin = new System.Windows.Forms.Padding(14);
            this.materialCard1.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialCard1.Name = "materialCard1";
            this.materialCard1.Padding = new System.Windows.Forms.Padding(14);
            this.materialCard1.Size = new System.Drawing.Size(339, 194);
            this.materialCard1.TabIndex = 0;
            // 
            // LegaktivabbDolgozo
            // 
            this.LegaktivabbDolgozo.AutoSize = true;
            this.LegaktivabbDolgozo.Depth = 0;
            this.LegaktivabbDolgozo.Font = new System.Drawing.Font("Roboto", 34F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.LegaktivabbDolgozo.FontType = MaterialSkin.MaterialSkinManager.fontType.H4;
            this.LegaktivabbDolgozo.Location = new System.Drawing.Point(96, 74);
            this.LegaktivabbDolgozo.MouseState = MaterialSkin.MouseState.HOVER;
            this.LegaktivabbDolgozo.Name = "LegaktivabbDolgozo";
            this.LegaktivabbDolgozo.Size = new System.Drawing.Size(152, 41);
            this.LegaktivabbDolgozo.TabIndex = 1;
            this.LegaktivabbDolgozo.Text = "Betöltés...";
            // 
            // materialLabel1
            // 
            this.materialLabel1.AutoSize = true;
            this.materialLabel1.Depth = 0;
            this.materialLabel1.Font = new System.Drawing.Font("Roboto Medium", 20F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.materialLabel1.FontType = MaterialSkin.MaterialSkinManager.fontType.H6;
            this.materialLabel1.Location = new System.Drawing.Point(80, 14);
            this.materialLabel1.MouseState = MaterialSkin.MouseState.HOVER;
            this.materialLabel1.Name = "materialLabel1";
            this.materialLabel1.Size = new System.Drawing.Size(185, 24);
            this.materialLabel1.TabIndex = 0;
            this.materialLabel1.Text = "Legaktívabb dolgozó";
            this.materialLabel1.Click += new System.EventHandler(this.materialLabel1_Click);
            // 
            // tabDolgozok
            // 
            this.tabDolgozok.Controls.Add(this.btnTorles);
            this.tabDolgozok.Controls.Add(this.btnSzerkesztes);
            this.tabDolgozok.Controls.Add(this.btnFrissites);
            this.tabDolgozok.Controls.Add(this.btnUjDolgozo);
            this.tabDolgozok.Controls.Add(this.dgvDolgozok);
            this.tabDolgozok.Location = new System.Drawing.Point(4, 22);
            this.tabDolgozok.Name = "tabDolgozok";
            this.tabDolgozok.Padding = new System.Windows.Forms.Padding(3);
            this.tabDolgozok.Size = new System.Drawing.Size(1186, 707);
            this.tabDolgozok.TabIndex = 1;
            this.tabDolgozok.Text = "Dolgozók";
            this.tabDolgozok.UseVisualStyleBackColor = true;
            // 
            // btnTorles
            // 
            this.btnTorles.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnTorles.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnTorles.Depth = 0;
            this.btnTorles.HighEmphasis = true;
            this.btnTorles.Icon = null;
            this.btnTorles.Location = new System.Drawing.Point(294, 625);
            this.btnTorles.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnTorles.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnTorles.Name = "btnTorles";
            this.btnTorles.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnTorles.Size = new System.Drawing.Size(75, 36);
            this.btnTorles.TabIndex = 4;
            this.btnTorles.Text = "Törlés";
            this.btnTorles.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnTorles.UseAccentColor = false;
            this.btnTorles.UseVisualStyleBackColor = true;
            this.btnTorles.Click += new System.EventHandler(this.btnTorles_Click);
            // 
            // btnSzerkesztes
            // 
            this.btnSzerkesztes.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnSzerkesztes.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnSzerkesztes.Depth = 0;
            this.btnSzerkesztes.HighEmphasis = true;
            this.btnSzerkesztes.Icon = null;
            this.btnSzerkesztes.Location = new System.Drawing.Point(168, 625);
            this.btnSzerkesztes.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnSzerkesztes.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnSzerkesztes.Name = "btnSzerkesztes";
            this.btnSzerkesztes.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnSzerkesztes.Size = new System.Drawing.Size(118, 36);
            this.btnSzerkesztes.TabIndex = 3;
            this.btnSzerkesztes.Text = "Szerkesztés";
            this.btnSzerkesztes.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnSzerkesztes.UseAccentColor = false;
            this.btnSzerkesztes.UseVisualStyleBackColor = true;
            this.btnSzerkesztes.Click += new System.EventHandler(this.btnSzerkesztes_Click);
            // 
            // btnFrissites
            // 
            this.btnFrissites.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnFrissites.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnFrissites.Depth = 0;
            this.btnFrissites.HighEmphasis = true;
            this.btnFrissites.Icon = null;
            this.btnFrissites.Location = new System.Drawing.Point(377, 625);
            this.btnFrissites.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnFrissites.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnFrissites.Name = "btnFrissites";
            this.btnFrissites.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnFrissites.Size = new System.Drawing.Size(143, 36);
            this.btnFrissites.TabIndex = 2;
            this.btnFrissites.Text = "Lista frissítése";
            this.btnFrissites.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnFrissites.UseAccentColor = false;
            this.btnFrissites.UseVisualStyleBackColor = true;
            this.btnFrissites.Click += new System.EventHandler(this.btnFrissites_Click);
            // 
            // btnUjDolgozo
            // 
            this.btnUjDolgozo.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnUjDolgozo.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnUjDolgozo.Depth = 0;
            this.btnUjDolgozo.HighEmphasis = true;
            this.btnUjDolgozo.Icon = null;
            this.btnUjDolgozo.Location = new System.Drawing.Point(50, 625);
            this.btnUjDolgozo.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnUjDolgozo.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnUjDolgozo.Name = "btnUjDolgozo";
            this.btnUjDolgozo.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnUjDolgozo.Size = new System.Drawing.Size(110, 36);
            this.btnUjDolgozo.TabIndex = 1;
            this.btnUjDolgozo.Text = "Új dolgozó";
            this.btnUjDolgozo.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnUjDolgozo.UseAccentColor = false;
            this.btnUjDolgozo.UseVisualStyleBackColor = true;
            this.btnUjDolgozo.Click += new System.EventHandler(this.btnUjDolgozo_Click);
            // 
            // dgvDolgozok
            // 
            this.dgvDolgozok.AllowUserToAddRows = false;
            this.dgvDolgozok.AllowUserToOrderColumns = true;
            this.dgvDolgozok.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.Fill;
            this.dgvDolgozok.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvDolgozok.Location = new System.Drawing.Point(50, 54);
            this.dgvDolgozok.Name = "dgvDolgozok";
            this.dgvDolgozok.ReadOnly = true;
            this.dgvDolgozok.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dgvDolgozok.Size = new System.Drawing.Size(1056, 562);
            this.dgvDolgozok.TabIndex = 0;
            // 
            // tabKategoriak
            // 
            this.tabKategoriak.Controls.Add(this.btnFrissitSzolg);
            this.tabKategoriak.Controls.Add(this.btnTorolSzolg);
            this.tabKategoriak.Controls.Add(this.btnSzerkesztSzolg);
            this.tabKategoriak.Controls.Add(this.btnUjSzolgaltatas);
            this.tabKategoriak.Controls.Add(this.dgvSzolgaltatasok);
            this.tabKategoriak.Location = new System.Drawing.Point(4, 22);
            this.tabKategoriak.Name = "tabKategoriak";
            this.tabKategoriak.Size = new System.Drawing.Size(1186, 707);
            this.tabKategoriak.TabIndex = 2;
            this.tabKategoriak.Text = "Kategóriák/Szolgáltatások";
            this.tabKategoriak.UseVisualStyleBackColor = true;
            // 
            // btnFrissitSzolg
            // 
            this.btnFrissitSzolg.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnFrissitSzolg.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnFrissitSzolg.Depth = 0;
            this.btnFrissitSzolg.HighEmphasis = true;
            this.btnFrissitSzolg.Icon = null;
            this.btnFrissitSzolg.Location = new System.Drawing.Point(395, 592);
            this.btnFrissitSzolg.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnFrissitSzolg.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnFrissitSzolg.Name = "btnFrissitSzolg";
            this.btnFrissitSzolg.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnFrissitSzolg.Size = new System.Drawing.Size(143, 36);
            this.btnFrissitSzolg.TabIndex = 4;
            this.btnFrissitSzolg.Text = "Lista frissítése";
            this.btnFrissitSzolg.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnFrissitSzolg.UseAccentColor = false;
            this.btnFrissitSzolg.UseVisualStyleBackColor = true;
            this.btnFrissitSzolg.Click += new System.EventHandler(this.btnFrissitSzolg_Click);
            // 
            // btnTorolSzolg
            // 
            this.btnTorolSzolg.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnTorolSzolg.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnTorolSzolg.Depth = 0;
            this.btnTorolSzolg.HighEmphasis = true;
            this.btnTorolSzolg.Icon = null;
            this.btnTorolSzolg.Location = new System.Drawing.Point(312, 592);
            this.btnTorolSzolg.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnTorolSzolg.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnTorolSzolg.Name = "btnTorolSzolg";
            this.btnTorolSzolg.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnTorolSzolg.Size = new System.Drawing.Size(75, 36);
            this.btnTorolSzolg.TabIndex = 3;
            this.btnTorolSzolg.Text = "Törlés";
            this.btnTorolSzolg.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnTorolSzolg.UseAccentColor = false;
            this.btnTorolSzolg.UseVisualStyleBackColor = true;
            this.btnTorolSzolg.Click += new System.EventHandler(this.btnTorolSzolg_Click);
            // 
            // btnSzerkesztSzolg
            // 
            this.btnSzerkesztSzolg.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnSzerkesztSzolg.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnSzerkesztSzolg.Depth = 0;
            this.btnSzerkesztSzolg.HighEmphasis = true;
            this.btnSzerkesztSzolg.Icon = null;
            this.btnSzerkesztSzolg.Location = new System.Drawing.Point(186, 592);
            this.btnSzerkesztSzolg.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnSzerkesztSzolg.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnSzerkesztSzolg.Name = "btnSzerkesztSzolg";
            this.btnSzerkesztSzolg.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnSzerkesztSzolg.Size = new System.Drawing.Size(118, 36);
            this.btnSzerkesztSzolg.TabIndex = 2;
            this.btnSzerkesztSzolg.Text = "Szerkesztés";
            this.btnSzerkesztSzolg.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnSzerkesztSzolg.UseAccentColor = false;
            this.btnSzerkesztSzolg.UseVisualStyleBackColor = true;
            this.btnSzerkesztSzolg.Click += new System.EventHandler(this.btnSzerkesztSzolg_Click);
            // 
            // btnUjSzolgaltatas
            // 
            this.btnUjSzolgaltatas.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnUjSzolgaltatas.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnUjSzolgaltatas.Depth = 0;
            this.btnUjSzolgaltatas.HighEmphasis = true;
            this.btnUjSzolgaltatas.Icon = null;
            this.btnUjSzolgaltatas.Location = new System.Drawing.Point(26, 592);
            this.btnUjSzolgaltatas.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnUjSzolgaltatas.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnUjSzolgaltatas.Name = "btnUjSzolgaltatas";
            this.btnUjSzolgaltatas.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnUjSzolgaltatas.Size = new System.Drawing.Size(152, 36);
            this.btnUjSzolgaltatas.TabIndex = 1;
            this.btnUjSzolgaltatas.Text = "Új szolgáltatás";
            this.btnUjSzolgaltatas.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnUjSzolgaltatas.UseAccentColor = false;
            this.btnUjSzolgaltatas.UseVisualStyleBackColor = true;
            this.btnUjSzolgaltatas.Click += new System.EventHandler(this.btnUjSzolgaltatas_Click);
            // 
            // dgvSzolgaltatasok
            // 
            this.dgvSzolgaltatasok.AllowUserToAddRows = false;
            this.dgvSzolgaltatasok.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.Fill;
            this.dgvSzolgaltatasok.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvSzolgaltatasok.Location = new System.Drawing.Point(26, 22);
            this.dgvSzolgaltatasok.Name = "dgvSzolgaltatasok";
            this.dgvSzolgaltatasok.ReadOnly = true;
            this.dgvSzolgaltatasok.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dgvSzolgaltatasok.Size = new System.Drawing.Size(1117, 561);
            this.dgvSzolgaltatasok.TabIndex = 0;
            // 
            // tabNaptar
            // 
            this.tabNaptar.Controls.Add(this.btnFoglalasTorles);
            this.tabNaptar.Controls.Add(this.dgvFoglalasok);
            this.tabNaptar.Controls.Add(this.btnMindenFoglalas);
            this.tabNaptar.Controls.Add(this.btnSzures);
            this.tabNaptar.Controls.Add(this.cmbDolgozo);
            this.tabNaptar.Controls.Add(this.dtpDatum);
            this.tabNaptar.Location = new System.Drawing.Point(4, 22);
            this.tabNaptar.Name = "tabNaptar";
            this.tabNaptar.Size = new System.Drawing.Size(889, 707);
            this.tabNaptar.TabIndex = 3;
            this.tabNaptar.Text = "Naptár és Foglalások";
            this.tabNaptar.UseVisualStyleBackColor = true;
            // 
            // tabVendegek
            // 
            this.tabVendegek.Controls.Add(this.btnKorlatozas);
            this.tabVendegek.Controls.Add(this.btnFrissitVendegek);
            this.tabVendegek.Controls.Add(this.btnTorolVendeg);
            this.tabVendegek.Controls.Add(this.dgvVendegek);
            this.tabVendegek.Location = new System.Drawing.Point(4, 22);
            this.tabVendegek.Name = "tabVendegek";
            this.tabVendegek.Size = new System.Drawing.Size(889, 707);
            this.tabVendegek.TabIndex = 4;
            this.tabVendegek.Text = "Vendégek kezelése";
            this.tabVendegek.UseVisualStyleBackColor = true;
            // 
            // tabVelemenyek
            // 
            this.tabVelemenyek.Controls.Add(this.btnTorolVelemeny);
            this.tabVelemenyek.Controls.Add(this.btnFrissitVelemenyek);
            this.tabVelemenyek.Controls.Add(this.dgvVelemenyek);
            this.tabVelemenyek.Location = new System.Drawing.Point(4, 22);
            this.tabVelemenyek.Name = "tabVelemenyek";
            this.tabVelemenyek.Size = new System.Drawing.Size(889, 707);
            this.tabVelemenyek.TabIndex = 5;
            this.tabVelemenyek.Text = "Vélemények";
            this.tabVelemenyek.UseVisualStyleBackColor = true;
            // 
            // dtpDatum
            // 
            this.dtpDatum.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtpDatum.Location = new System.Drawing.Point(3, 3);
            this.dtpDatum.Name = "dtpDatum";
            this.dtpDatum.Size = new System.Drawing.Size(148, 20);
            this.dtpDatum.TabIndex = 0;
            // 
            // cmbDolgozo
            // 
            this.cmbDolgozo.AutoResize = false;
            this.cmbDolgozo.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(255)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.cmbDolgozo.Depth = 0;
            this.cmbDolgozo.DrawMode = System.Windows.Forms.DrawMode.OwnerDrawVariable;
            this.cmbDolgozo.DropDownHeight = 174;
            this.cmbDolgozo.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cmbDolgozo.DropDownWidth = 121;
            this.cmbDolgozo.Font = new System.Drawing.Font("Roboto Medium", 14F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Pixel);
            this.cmbDolgozo.ForeColor = System.Drawing.Color.FromArgb(((int)(((byte)(222)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))), ((int)(((byte)(0)))));
            this.cmbDolgozo.FormattingEnabled = true;
            this.cmbDolgozo.Hint = "Válassz dolgozót...";
            this.cmbDolgozo.IntegralHeight = false;
            this.cmbDolgozo.ItemHeight = 43;
            this.cmbDolgozo.Location = new System.Drawing.Point(157, 4);
            this.cmbDolgozo.MaxDropDownItems = 4;
            this.cmbDolgozo.MouseState = MaterialSkin.MouseState.OUT;
            this.cmbDolgozo.Name = "cmbDolgozo";
            this.cmbDolgozo.Size = new System.Drawing.Size(199, 49);
            this.cmbDolgozo.StartIndex = 0;
            this.cmbDolgozo.TabIndex = 1;
            // 
            // btnSzures
            // 
            this.btnSzures.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnSzures.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnSzures.Depth = 0;
            this.btnSzures.HighEmphasis = true;
            this.btnSzures.Icon = null;
            this.btnSzures.Location = new System.Drawing.Point(363, 6);
            this.btnSzures.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnSzures.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnSzures.Name = "btnSzures";
            this.btnSzures.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnSzures.Size = new System.Drawing.Size(75, 36);
            this.btnSzures.TabIndex = 2;
            this.btnSzures.Text = "Szűrés";
            this.btnSzures.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnSzures.UseAccentColor = false;
            this.btnSzures.UseVisualStyleBackColor = true;
            this.btnSzures.Click += new System.EventHandler(this.btnSzures_Click);
            // 
            // btnMindenFoglalas
            // 
            this.btnMindenFoglalas.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnMindenFoglalas.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnMindenFoglalas.Depth = 0;
            this.btnMindenFoglalas.HighEmphasis = true;
            this.btnMindenFoglalas.Icon = null;
            this.btnMindenFoglalas.Location = new System.Drawing.Point(446, 6);
            this.btnMindenFoglalas.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnMindenFoglalas.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnMindenFoglalas.Name = "btnMindenFoglalas";
            this.btnMindenFoglalas.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnMindenFoglalas.Size = new System.Drawing.Size(152, 36);
            this.btnMindenFoglalas.TabIndex = 3;
            this.btnMindenFoglalas.Text = "Összes foglalás";
            this.btnMindenFoglalas.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnMindenFoglalas.UseAccentColor = false;
            this.btnMindenFoglalas.UseVisualStyleBackColor = true;
            this.btnMindenFoglalas.Click += new System.EventHandler(this.btnMindenFoglalas_Click);
            // 
            // dgvFoglalasok
            // 
            this.dgvFoglalasok.AllowUserToAddRows = false;
            this.dgvFoglalasok.AutoSizeColumnsMode = System.Windows.Forms.DataGridViewAutoSizeColumnsMode.Fill;
            this.dgvFoglalasok.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvFoglalasok.Location = new System.Drawing.Point(24, 81);
            this.dgvFoglalasok.Name = "dgvFoglalasok";
            this.dgvFoglalasok.ReadOnly = true;
            this.dgvFoglalasok.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.dgvFoglalasok.Size = new System.Drawing.Size(838, 521);
            this.dgvFoglalasok.TabIndex = 4;
            // 
            // btnFoglalasTorles
            // 
            this.btnFoglalasTorles.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnFoglalasTorles.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnFoglalasTorles.Depth = 0;
            this.btnFoglalasTorles.HighEmphasis = true;
            this.btnFoglalasTorles.Icon = null;
            this.btnFoglalasTorles.Location = new System.Drawing.Point(24, 611);
            this.btnFoglalasTorles.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnFoglalasTorles.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnFoglalasTorles.Name = "btnFoglalasTorles";
            this.btnFoglalasTorles.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnFoglalasTorles.Size = new System.Drawing.Size(229, 36);
            this.btnFoglalasTorles.TabIndex = 5;
            this.btnFoglalasTorles.Text = "Kijelölt foglalás törlése";
            this.btnFoglalasTorles.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnFoglalasTorles.UseAccentColor = false;
            this.btnFoglalasTorles.UseVisualStyleBackColor = true;
            this.btnFoglalasTorles.Click += new System.EventHandler(this.btnFoglalasTorles_Click);
            // 
            // dgvVendegek
            // 
            this.dgvVendegek.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvVendegek.Location = new System.Drawing.Point(369, 137);
            this.dgvVendegek.Name = "dgvVendegek";
            this.dgvVendegek.Size = new System.Drawing.Size(240, 150);
            this.dgvVendegek.TabIndex = 0;
            // 
            // btnTorolVendeg
            // 
            this.btnTorolVendeg.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnTorolVendeg.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnTorolVendeg.Depth = 0;
            this.btnTorolVendeg.HighEmphasis = true;
            this.btnTorolVendeg.Icon = null;
            this.btnTorolVendeg.Location = new System.Drawing.Point(382, 386);
            this.btnTorolVendeg.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnTorolVendeg.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnTorolVendeg.Name = "btnTorolVendeg";
            this.btnTorolVendeg.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnTorolVendeg.Size = new System.Drawing.Size(116, 36);
            this.btnTorolVendeg.TabIndex = 1;
            this.btnTorolVendeg.Text = "Tag törlése";
            this.btnTorolVendeg.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnTorolVendeg.UseAccentColor = false;
            this.btnTorolVendeg.UseVisualStyleBackColor = true;
            this.btnTorolVendeg.Click += new System.EventHandler(this.btnTorolVendeg_Click);
            // 
            // btnFrissitVendegek
            // 
            this.btnFrissitVendegek.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnFrissitVendegek.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnFrissitVendegek.Depth = 0;
            this.btnFrissitVendegek.HighEmphasis = true;
            this.btnFrissitVendegek.Icon = null;
            this.btnFrissitVendegek.Location = new System.Drawing.Point(386, 335);
            this.btnFrissitVendegek.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnFrissitVendegek.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnFrissitVendegek.Name = "btnFrissitVendegek";
            this.btnFrissitVendegek.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnFrissitVendegek.Size = new System.Drawing.Size(143, 36);
            this.btnFrissitVendegek.TabIndex = 2;
            this.btnFrissitVendegek.Text = "Lista frissítése";
            this.btnFrissitVendegek.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnFrissitVendegek.UseAccentColor = false;
            this.btnFrissitVendegek.UseVisualStyleBackColor = true;
            this.btnFrissitVendegek.Click += new System.EventHandler(this.btnFrissitVendegek_Click);
            // 
            // dgvVelemenyek
            // 
            this.dgvVelemenyek.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvVelemenyek.Location = new System.Drawing.Point(337, 74);
            this.dgvVelemenyek.Name = "dgvVelemenyek";
            this.dgvVelemenyek.Size = new System.Drawing.Size(240, 150);
            this.dgvVelemenyek.TabIndex = 0;
            // 
            // btnFrissitVelemenyek
            // 
            this.btnFrissitVelemenyek.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnFrissitVelemenyek.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnFrissitVelemenyek.Depth = 0;
            this.btnFrissitVelemenyek.HighEmphasis = true;
            this.btnFrissitVelemenyek.Icon = null;
            this.btnFrissitVelemenyek.Location = new System.Drawing.Point(379, 270);
            this.btnFrissitVelemenyek.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnFrissitVelemenyek.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnFrissitVelemenyek.Name = "btnFrissitVelemenyek";
            this.btnFrissitVelemenyek.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnFrissitVelemenyek.Size = new System.Drawing.Size(143, 36);
            this.btnFrissitVelemenyek.TabIndex = 1;
            this.btnFrissitVelemenyek.Text = "Lista frissítése";
            this.btnFrissitVelemenyek.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnFrissitVelemenyek.UseAccentColor = false;
            this.btnFrissitVelemenyek.UseVisualStyleBackColor = true;
            this.btnFrissitVelemenyek.Click += new System.EventHandler(this.btnFrissitVelemenyek_Click);
            // 
            // btnTorolVelemeny
            // 
            this.btnTorolVelemeny.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnTorolVelemeny.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnTorolVelemeny.Depth = 0;
            this.btnTorolVelemeny.HighEmphasis = true;
            this.btnTorolVelemeny.Icon = null;
            this.btnTorolVelemeny.Location = new System.Drawing.Point(373, 335);
            this.btnTorolVelemeny.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnTorolVelemeny.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnTorolVelemeny.Name = "btnTorolVelemeny";
            this.btnTorolVelemeny.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnTorolVelemeny.Size = new System.Drawing.Size(143, 36);
            this.btnTorolVelemeny.TabIndex = 2;
            this.btnTorolVelemeny.Text = "Kijelölt vélemény törlése";
            this.btnTorolVelemeny.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnTorolVelemeny.UseAccentColor = false;
            this.btnTorolVelemeny.UseVisualStyleBackColor = true;
            this.btnTorolVelemeny.Click += new System.EventHandler(this.btnTorolVelemeny_Click);
            // 
            // btnKorlatozas
            // 
            this.btnKorlatozas.AutoSizeMode = System.Windows.Forms.AutoSizeMode.GrowAndShrink;
            this.btnKorlatozas.Density = MaterialSkin.Controls.MaterialButton.MaterialButtonDensity.Default;
            this.btnKorlatozas.Depth = 0;
            this.btnKorlatozas.HighEmphasis = true;
            this.btnKorlatozas.Icon = null;
            this.btnKorlatozas.Location = new System.Drawing.Point(212, 311);
            this.btnKorlatozas.Margin = new System.Windows.Forms.Padding(4, 6, 4, 6);
            this.btnKorlatozas.MouseState = MaterialSkin.MouseState.HOVER;
            this.btnKorlatozas.Name = "btnKorlatozas";
            this.btnKorlatozas.NoAccentTextColor = System.Drawing.Color.Empty;
            this.btnKorlatozas.Size = new System.Drawing.Size(143, 36);
            this.btnKorlatozas.TabIndex = 3;
            this.btnKorlatozas.Text = "Korlátozás beállítása";
            this.btnKorlatozas.Type = MaterialSkin.Controls.MaterialButton.MaterialButtonType.Contained;
            this.btnKorlatozas.UseAccentColor = false;
            this.btnKorlatozas.UseVisualStyleBackColor = true;
            this.btnKorlatozas.Click += new System.EventHandler(this.btnKorlatozas_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(903, 800);
            this.Controls.Add(this.materialTabControl1);
            this.DrawerShowIconsWhenHidden = true;
            this.DrawerTabControl = this.materialTabControl1;
            this.Name = "Form1";
            this.Text = "Fresh Szalon admin felület";
            this.materialTabControl1.ResumeLayout(false);
            this.tabVezerlopult.ResumeLayout(false);
            this.materialCard4.ResumeLayout(false);
            this.materialCard4.PerformLayout();
            this.materialCard3.ResumeLayout(false);
            this.materialCard3.PerformLayout();
            this.materialCard2.ResumeLayout(false);
            this.materialCard2.PerformLayout();
            this.materialCard1.ResumeLayout(false);
            this.materialCard1.PerformLayout();
            this.tabDolgozok.ResumeLayout(false);
            this.tabDolgozok.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvDolgozok)).EndInit();
            this.tabKategoriak.ResumeLayout(false);
            this.tabKategoriak.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvSzolgaltatasok)).EndInit();
            this.tabNaptar.ResumeLayout(false);
            this.tabNaptar.PerformLayout();
            this.tabVendegek.ResumeLayout(false);
            this.tabVendegek.PerformLayout();
            this.tabVelemenyek.ResumeLayout(false);
            this.tabVelemenyek.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvFoglalasok)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.dgvVendegek)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.dgvVelemenyek)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private MaterialSkin.Controls.MaterialTabControl materialTabControl1;
        private System.Windows.Forms.TabPage tabVezerlopult;
        private System.Windows.Forms.TabPage tabDolgozok;
        private System.Windows.Forms.TabPage tabKategoriak;
        private System.Windows.Forms.TabPage tabNaptar;
        private System.Windows.Forms.TabPage tabVendegek;
        private System.Windows.Forms.TabPage tabVelemenyek;
        private MaterialSkin.Controls.MaterialCard materialCard1;
        private MaterialSkin.Controls.MaterialLabel materialLabel1;
        private MaterialSkin.Controls.MaterialCard materialCard2;
        private MaterialSkin.Controls.MaterialCard materialCard3;
        private MaterialSkin.Controls.MaterialLabel LegnepszerubbSzolg;
        private MaterialSkin.Controls.MaterialLabel materialLabel5;
        private MaterialSkin.Controls.MaterialLabel HetiBevetel;
        private MaterialSkin.Controls.MaterialLabel materialLabel3;
        private MaterialSkin.Controls.MaterialLabel LegaktivabbDolgozo;
        private MaterialSkin.Controls.MaterialCard materialCard4;
        private MaterialSkin.Controls.MaterialLabel RegisztraltTagok;
        private MaterialSkin.Controls.MaterialLabel materialLabel4;
        private MaterialSkin.Controls.MaterialButton btnFrissites;
        private MaterialSkin.Controls.MaterialButton btnUjDolgozo;
        private System.Windows.Forms.DataGridView dgvDolgozok;
        private MaterialSkin.Controls.MaterialButton btnTorles;
        private MaterialSkin.Controls.MaterialButton btnSzerkesztes;
        private System.Windows.Forms.DataGridView dgvSzolgaltatasok;
        private MaterialSkin.Controls.MaterialButton btnTorolSzolg;
        private MaterialSkin.Controls.MaterialButton btnSzerkesztSzolg;
        private MaterialSkin.Controls.MaterialButton btnUjSzolgaltatas;
        private MaterialSkin.Controls.MaterialButton btnFrissitSzolg;
        private System.Windows.Forms.DateTimePicker dtpDatum;
        private MaterialSkin.Controls.MaterialButton btnMindenFoglalas;
        private MaterialSkin.Controls.MaterialButton btnSzures;
        private MaterialSkin.Controls.MaterialComboBox cmbDolgozo;
        private MaterialSkin.Controls.MaterialButton btnFoglalasTorles;
        private System.Windows.Forms.DataGridView dgvFoglalasok;
        private MaterialSkin.Controls.MaterialButton btnFrissitVendegek;
        private MaterialSkin.Controls.MaterialButton btnTorolVendeg;
        private System.Windows.Forms.DataGridView dgvVendegek;
        private MaterialSkin.Controls.MaterialButton btnFrissitVelemenyek;
        private System.Windows.Forms.DataGridView dgvVelemenyek;
        private MaterialSkin.Controls.MaterialButton btnTorolVelemeny;
        private MaterialSkin.Controls.MaterialButton btnKorlatozas;
    }
}

