@if(!empty($campagne))
<?php

    $sommaire = $campagne->map(function($item)
    {
        if($item->type->id == 7){
            return $item->arrets->lists('reference');
        }
        return $item->type->id == 5 ? $item->reference : $item->titre;
    });
?>
@if(!$sommaire->isEmpty())
    <!-- Bloc -->
    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="tableReset">
     <tr bgcolor="ffffff"><td colspan="3" height="35"></td></tr><!-- space -->
     <tr bgcolor="ffffff" align="center" class="resetMarge">
         <td class="resetMarge">
             <!-- Bloc content-->
             <table border="0" width="580" align="center" cellpadding="0" cellspacing="0" class="tableReset contentForm">
                 <tr>
                     <td valign="top" width="580" class="resetMarge">
                         <?php $sommaire = array_flatten($sommaire->toArray()); ?>
                         <h2>Sommaire</h2>
                         <ol>
                             @foreach($sommaire as $list)
                                 <li style="font-size: 14px;line-height: 20px; margin-bottom: 3px;">{!! $list !!}</li>
                             @endforeach
                         </ol>
                     </td>
                 </tr>
             </table>
             <!-- Bloc content-->
         </td>
     </tr>
     <tr bgcolor="ffffff"><td colspan="3" height="35" class="blocBorder"></td></tr><!-- space -->
    </table>
    <!-- End bloc -->
    @endif
@endif