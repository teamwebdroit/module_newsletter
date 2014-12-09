@extends('layouts.admin')

@section('content')

<?php  $custom = new Custom; ?>

<div id="page-content">
	<div id="wrap">
	
		<div id="page-heading">
			<ol class="breadcrumb">
				<li class="active"><a href="{{ url('admin') }}">Dashboard</a></li>
			</ol>
			<h1>Analyses</h1>
			<div class="options">
	            <div class="btn-toolbar">
	                <a href="{{ url('admin/analyses/create/'.$pid) }}" class="btn btn-default"><i class="fa fa-plus"></i> &nbsp;Ajouter analyse</a>
	            </div>
			</div>
		</div>
				
		<div class="container">		
	
		<!-- Arrets bail -->
			<div class="row">
	          <div class="col-md-12">
					
	              <div class="panel panel-sky">               
	                  <div class="panel-body collapse in">
	                                    	          
							<h3 class="text-center">
								@if ( $pid == 195 )	
									{{HTML::image('/images/bail/logo.png')}}
								@endif 
								@if ( $pid == 207 )	
									{{HTML::image('/images/admin/matrimonial.jpg')}}
								@endif 
							</h3>
	                  
	                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered analyse_table" id="users_table">
								<thead>
									<th>Auteur</th>
									<th>Date de parution</th>
									<th>Résumé</th>
									<th>Arrêts</th>
									<th>Options</th>
								</thead>
								<tbody>
									<?php if(!empty($analyses)){ ?>
	                                <?php foreach($analyses as $analyse)
	                                	  {  
	                                		
	                                		$arrets_categories = $analyse->analyses_categories;
	                                		$arrets_analyses   = $analyse->arrets_analyses;	
	
		                                ?>
	                                    <tr class="odd gradeX">
	                                        <td class="center"><strong><?php echo $analyse->authors; ?></strong></td>	
	                                        <td class="center"><?php echo $custom->getCreatedAtAttribute($analyse->pub_date); ?></td>	                                        
	                                        <td class="center"><?php echo $custom->limit_words($analyse->abstract,20); ?></td>
	                                        <td class="center">
		                                        <?php if( !$arrets_analyses->isEmpty() ) {?>
		                                        <ul class="fa-ul">
		                                        <?php 
		                                        	foreach($arrets_analyses as $arrets_analyse)
													{	
												  		echo '<li><a href="'.url('admin/arrets/'.$arrets_analyse->id).'">
												  					<i class="fa-li fa fa-bookmark"></i>'.$arrets_analyse->reference.'</a></li>';
												    } 
  												?>
		                                        </ul>
		                                        <?php } ?>
	                                        </td>
	                                        <td><a class="btn btn-primary btn-sm edit_btn" href="{{ url('admin/analyses/'.$analyse->id) }}">éditer</a></td>
	                                    </tr>
	                                <?php }} ?>
								</tbody>
							</table>
							
	                    </div><!-- end body panel --> 
                    </div><!-- end panel -->    
                                
                </div><!-- end col -->           
			</div><!-- end row -->
			
		</div><!-- end container  -->
	</div><!-- end wrap  -->
</div><!-- end pge-content  -->

@stop
