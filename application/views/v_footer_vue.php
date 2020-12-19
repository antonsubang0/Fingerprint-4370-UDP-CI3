<script src="<?= base_url(); ?>/berkas/js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url(); ?>/berkas/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.js" integrity="sha512-bYkaBWaFtfPIMYt9+CX/4DWgfrjcHinjerNYxQmQx1VM76eUsPPKZa5zWV8KksVkBF/DaHSADCwil2J5Uq2ctA==" crossorigin="anonymous"></script>
<script type="text/javascript">
	var loading = document.getElementsByClassName("loading-cs");
	loading[0].style.display = 'none';
	var app = new Vue({
	  	el: '#app',
	  	data () {
    	return {
      		info: null
    		}
  		},
	  mounted () {
	    axios
	      .get('http://localhost/ci/cuti/ajaxalldata')
	      .then(response => {
	        this.info = response.data;
	        console.log(this.info);
	      })
	      .catch(error => {
	        console.log(error)
	        this.errored = true
	      })
	      .finally(() => this.loading = false)
	  },
	  methods : {
	  	tambah : function () {
	  		console.log('asik');
	  	},
	  	informasi : function ($a) {
	  		console.log($a);
	  	}
	  } 
	})
</script>