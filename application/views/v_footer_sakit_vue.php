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
      		typeselect : null
    		}
  		},
	  mounted () {
	  	this.reload();
	  },
	  methods : {
	  	reload : function () {
	  		axios.get('<?= base_url(); ?>sakit/ajaxsearch')
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
	  	deletesakit : function (e) {
	  		axios.get('<?= base_url(); ?>sakit/ajaxdelete/' + e)
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
	        let formData = {
	  			no : null,
	  			uid : this.userselect,
	  			tanggal : this.datatglcuti,
	  			reason : this.datakeperluan,
	  			type : this.typeselect,
	  			status : 1
	  		};
	  		axios({
			  	method: 'post',
			  	url: '<?= base_url(); ?>sakit/ajaxtambah',
			  	data: formData
			}).then(response => {
				console.log(response);
				if (response.data=='success') {
					this.userselect = null;
					this.reload();
				} else {
					alert(response.data);
				}
			}).catch(error => {
			    alert('Error');
			}).finally(() => this.loading = false)
	  	},
	  	btnmodaladd : function () {
	  		if (this.modaladdx == false) {
	  			this.modaladdx= true;
	  			axios.get('<?= base_url(); ?>sakit/ajaxallbagian')
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
	  		axios.get('<?= base_url(); ?>sakit/ajaxuserbagian/' + this.bagianselect)
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
	  	vuesearch : function () {
	  		axios.get('<?= base_url(); ?>sakit/ajaxsearch/' + this.search)
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
	  		console.log(this.datafull);
	  		axios({
			  	method: 'post',
			  	url: '<?= base_url(); ?>sakit/postprint',
			  	data: this.datafull
			}).then(response => {
				if (response.data=='success') {
					window.location.href = '<?= base_url(); ?>sakit/isprint';
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