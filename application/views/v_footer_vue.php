<script src="<?= base_url(); ?>berkas/js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url(); ?>berkas/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>berkas/js/vue.js"></script>
<script src="<?= base_url(); ?>berkas/js/axios.js"></script>
<script type="text/javascript">
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
      		datatglcuti : null
    		}
  		},
	  mounted () {
	  	this.reload();
	  },
	  methods : {
	  	reload : function () {
	  		axios.get('<?= base_url(); ?>cuti/ajaxalldata')
	      .then(response => {
	        this.info = response.data;
	        console.log(this.info);
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false);
	  	},
	  	tambah : function () {
	  		console.log('asik');
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
	  		let formData = {
	  			no : null,
	  			uid : this.userselect,
	  			tgl_cuti : this.datatglcuti,
	  			keperluan : this.datakeperluan,
	  			cuti : 1
	  		};
	  		axios({
			  	method: 'post',
			  	url: '<?= base_url(); ?>cuti/ajaxtambahcuti',
			  	data: formData
			}).then(response => {
				if (response.data='success') {
					this.reload();
				}
			}).catch(error => {
			    console.log(error);
			}).finally(() => this.loading = false)
	  	},
	  	btnmodaladd : function () {
	  		if (this.modaladdx == false) {
	  			this.modaladdx= true;
	  			axios.get('<?= base_url(); ?>cuti/ajaxalluser')
				      .then(response => {
				        this.userinfo = response.data;
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
	  	clsmodaldetail : function (argument) {
	  		this.detail=false;
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
	        this.info = response.data;
	      })
	      .catch(error => {
	        console.log(error);
	      })
	      .finally(() => this.loading = false)
	  	}
	  } 
	})
</script>