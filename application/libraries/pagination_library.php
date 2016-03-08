<?php
class Pagination_library
{
        function paginate_anchor($url, $queryPaging, $total, $per_page) {
        $prevlabel = "<strong><</strong>";
        $nextlabel = "<strong>></strong>";
        $out='';
        $out .= '<div class="pagin green">';
        $out.='<ul>';
        $page=$queryPaging;
        $tpages=ceil($total/$per_page);
        $adjacents=$per_page;
        if($page==1) {
                $out.= "<span>$prevlabel</span>";
        } else if($page==2) {
                $out.= "<a href='".$url."page=".($page-1)."'>$prevlabel</a>";
        }else {
                $out.= "<a href='".$url."page=".($page-1)."'>$prevlabel</a>";
 
        }            
        if($page>($adjacents+1)) {
                $out.= "<a href='".$url."page=1'>1</a>";
        }      
        if($page>($adjacents+2)) {
                $out.= "...\n";
        }        
        $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
        $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
        for($i=$pmin; $i<=$pmax; $i++) {
                if($i==$page) {
                        $out.= "<span>$i</span>";
                }else if($i==1) {
                        $out.= "<a href='".$url."page=$i'>$i</a>";
                }else {
                        $out.= "<a href='".$url."page=$i'>$i</a>";
                }
        }
 
        if($page<($tpages-$adjacents-1)) {
                $out.= "...\n";
        }        
        if($page<($tpages-$adjacents)) {
                $out.= "<a href='".$url."page=$tpages'>$tpages</a>";
        }
        if($page<$tpages) {
                $out.= "<a href='".$url."page=".($page+1)."'>$nextlabel</a>";
        }else {
                $out.= "<span>$nextlabel</span>";
        }
        $out.='</ul>';
        $out.= "</div>";
        if($total<$per_page)
        {
        return null;
        }else{
        return $out;
        }
    }
   
   
}