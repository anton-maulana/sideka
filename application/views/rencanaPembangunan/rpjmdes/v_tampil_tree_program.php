<style>
.tree {
    min-height:20px;
    padding:5px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:2px solid #428bca;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:2px solid #428bca;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
	background-color:#F8F8F8;
	border:1px solid #428bca;
	color:#428bca;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border-radius:2px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
	background-color:#428bca;
	color:#fff;
    border:1px solid #94a0b4;
    
}
</style>
<h3><?= $page_title ?></h3>
<h5><b><?= $deskripsi_title ?></b></h5>
<legend></legend>
<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>
<?php echo form_open('rencanaPembangunan/c_rpjmd/tampil_tree_program'); ?>

	<div class="panel panel-primary">
      <div class="panel-heading">
        <h4 class="panel-title">Pohon Program RPJMDes</h4>
      </div>
      <div class="panel-body">
          <div class="tree">
			<?php echo $program_list ?>
		</div>
      </div>
	  <div class="panel-footer">
      </div>
    </div>
<?php echo form_close(); ?>	
<legend></legend>
<script type="text/javascript">
$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch').find(' > i').addClass('fa fa-minus-square-o');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('medium');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign fa-plus-square-o').removeClass('icon-minus-sign fa-minus-square-o');
        } else {
            children.show('medium');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign fa-minus-square-o').removeClass('icon-plus-sign fa-plus-square-o');
        }
        e.stopPropagation();
    });
});
	</script>

<script>
function nav_active(){
	
	document.getElementById("a-data-perencanaan").className = "collapsed active";
	document.getElementById("perencanaan").className = "collapsed active";
	
	document.getElementById("a-data-rpjmdes").className = "collapsed active";
	document.getElementById("rpjmdes").className = "collapsed active";

	var d = document.getElementById("nav-tree_rpjmdes");
	d.className = d.className + "active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>