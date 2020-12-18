<script src="<?= base_url(); ?>/berkas/js/jquery-3.5.1.min.js"></script>
<script src="<?= base_url(); ?>/berkas/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script type="text/javascript">
	var loading = document.getElementsByClassName("loading-cs");
	loading[0].style.display = 'none';
	var app = new Vue({
	  el: '#app',
	  data: {
	    list: [
	    	{
	    		no : 1,
	    		tanggal : '10-12-2020',
	    		nama : 'Anton',
	    		bagian : 'Holding',
	    		keperluan : 'Santai',
	    		sisa : 11
	    	},
	    	{
	    		no : 2,
	    		tanggal : '11-11-2020',
	    		nama : 'Antonius',
	    		bagian : 'Pullchick',
	    		keperluan : 'Ngopi',
	    		sisa : 10
	    	}
	    ]
	  },
	  methods : {
	  	tambah : function () {
	  		console.log('asik');
	  	}
	  } 
	})
</script>