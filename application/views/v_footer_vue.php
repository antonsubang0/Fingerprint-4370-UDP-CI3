<script src="<?= base_url(); ?>berkas/js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url(); ?>berkas/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>berkas/js/vue.js"></script>
<script src="<?= base_url(); ?>berkas/js/axios.js"></script>
<script type="text/javascript">
	$("a[href$='"+ location.href +"']").parents('.collapse').addClass('show');
    $("a[href$='"+ location.href +"']").parent('li').addClass('bg-selector');
    $("a[href$='"+ location.href +"']").removeClass('text-body');
    $("a[href$='"+ location.href +"']").addClass('text-white'); 
    
	var loading = document.getElementsByClassName("loading-cs");
	loading[0].style.display = 'none';
	var app = new Vue({
	  	el: '#app',
	  	data () {
    	return {
      		info: null,
      		detail : false,
      		modaladdx : false,
      		search : '',
      		userinfo : null,
      		userselect : null,
      		datakeperluan : null,
      		datatglcuti : null,
      		jumlahdata : null,
      		jumlahpage : null,
      		perpage : 8,
      		page : [],
      		statepage :1,
      		datafull : null,
      		bagianinfo : null,
      		bagianselect : null,
    		}
  		},
	  mounted () {
	  	this.reload();
	  },
	  methods : {
	  	reload : function () {
	  		axios.get('<?= base_url(); ?>cuti/ajaxalldata')
	      .then(response => {
	      	this.page = [];
	      	this.statepage = 1;
	      	this.datafull = response.data;  
	        this.jumlahdata = response.data.length;
	        this.jumlahpage = Math.ceil(this.jumlahdata / this.perpage);
	        for (var i = 1; i <= this.jumlahpage ; i++) {
	        	this.page.push(i);
	        }
	        this.info = this.datafull.slice((this.statepage - 1) * this.perpage, (this.statepage - 1) * this.perpage + this.perpage);
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false);
	  	},
	  	paginate : function (e) {
	  		this.statepage = e;
	  		this.info = this.datafull.slice((this.statepage - 1) * this.perpage, (this.statepage - 1) * this.perpage + this.perpage);
	  	},
	  	deletex : function (e) {
	  		axios.get('<?= base_url(); ?>cuti/ajaxdeletecuti/' + e)
	      .then(response => {
	      	this.reload();
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	adduseruid : function () {
	  		this.modaladdx= false;
	  		if (this.userselect==null) {
	  			alert('User harus diisi');
	  			return;
	  		}
	  		axios.get('<?= base_url(); ?>cuti/ajaxinfodetail/' + this.userselect)
	      .then(response => {
	        let formData = {
	  			no : null,
	  			uid : this.userselect,
	  			tgl_cuti : this.datatglcuti,
	  			keperluan : this.datakeperluan,
	  			cuti : 12 - response.data[0].sisa_cuti + 1,
	  			enable : 1
	  		};
	  		axios({
			  	method: 'post',
			  	url: '<?= base_url(); ?>cuti/ajaxtambahcuti',
			  	data: formData
			}).then(response => {
				if (response.data=='success') {
					this.userselect = null;
					this.reload();
				} else {
					alert(response.data);
				}
			}).catch(error => {
			    alert('Error');
			}).finally(() => this.loading = false)
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	btnmodaladd : function () {
	  		if (this.modaladdx == false) {
	  			this.modaladdx= true;
	  			axios.get('<?= base_url(); ?>cuti/ajaxallbagian')
				      .then(response => {
				        this.bagianinfo = response.data;
				      })
				      .catch(error => {
				        console.log(error);
				      })
				      .finally(() => this.loading = false);
	  		} else {
	  			this.modaladdx= false;
	  			this.userselect = null;
      			this.datakeperluan = null;
      			this.datatglcuti = null;
	  		}
	  	},
	  	bybagian : function () {
	  		axios.get('<?= base_url(); ?>cuti/ajaxuserbagian/' + this.bagianselect)
	      .then(response => {
	        this.userinfo = response.data;
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	clsmodaldetail : function (argument) {
	  		this.detail=false;
	  		this.userselect = null;
	  	},
	  	informasi : function (uid) {
	  		axios.get('<?= base_url(); ?>cuti/ajaxinfodetail/' + uid)
	      .then(response => {
	        this.detail = response.data[0];
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	vuesearch : function () {
	  		axios.get('<?= base_url(); ?>cuti/ajaxsearchcuti/' + this.search)
	      .then(response => {
	      	if (response.data) {
	      		this.page = [];
	      		this.statepage = 1;
		      	this.datafull = response.data;  
		        this.jumlahdata = response.data.length;
		        this.jumlahpage = Math.ceil(this.jumlahdata / this.perpage);
		        for (var i = 1; i <= this.jumlahpage ; i++) {
		        	this.page.push(i);
		        }
		        this.info = this.datafull.slice((this.statepage - 1) * this.perpage, (this.statepage - 1) * this.perpage + this.perpage);
	      	} else {
	      		this.statepage = 1;
		        this.info = {
		        	tgl_cuti : 'not found',
		        	nama : 'not found',
		        	bnama : 'not found',
		        	keperluan : 'not found',
		        	cuti : 'not found',
		        	no : 'not found'
		        };
	      	}
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	},
	  	vuebtnprint : function () {
	  		axios({
			  	method: 'post',
			  	url: '<?= base_url(); ?>cuti/postprint',
			  	data: this.datafull
			}).then(response => {
				if (response.data=='success') {
					window.location.href = '<?= base_url(); ?>cuti/cutiprint';
				} else {
					alert('gatal');
				}
			}).catch(error => {
			    alert('gagal');
			}).finally(() => this.loading = false)
		}
	  } 
	})
</script>