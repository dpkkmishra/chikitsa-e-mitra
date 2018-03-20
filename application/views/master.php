<?php $this->load->view('templates/header'); ?>

<script>
  var BASE_URL = "<?php echo base_url(); ?>";
</script> 

<?php $this->load->view($main_view); ?>

<?php $this->load->view('templates/footer'); ?>