<?php 
require __DIR__."/classes/Corporateclients.php";
$Corpoclients = new Corporateclients();





if ($_POST['action'] == 'insertclientprice') {

    $corp_client            = $_POST['corpo_client_id'];
    $route_code             = $_POST['route_code'];
    $income_or_outgo        = $_POST['income_or_outgo'];
    $goods_type             = $_POST['goods_type'];
    $unit                   = $_POST['unit'];
    $price                  = $_POST['price'];

    $insertCoropprice =  $Corpoclients->insertCorpoPrice($corp_client ,$route_code,$income_or_outgo,$goods_type,$unit,$price);

    if ($insertCoropprice) {
        echo $insertCoropprice;
    }


}




//SERCH ROUTED COUNTR FOR PRINCIPAL PRICE SET

if ($_POST['action'] == 'serchprincicntry') {

    $corcompany = $_POST['corcompany'];
   // $route_code = $_POST['route_code'];
    if (empty($corcompany)) {
        echo "Please Select Company";
    }else{
     $query = "SELECT cpr.company_id,cpr.route_code,cpr.cntry_id,cntry.country_name FROM tbl_cour_comp_route as cpr,tbl_country as cntry WHERE cpr.cntry_id = cntry.country_id AND cpr.company_id = $corcompany";
    //$query = "SELECT cpr.company_id,cpr.route_code,cpr.cntry_id,cntry.country_name FROM tbl_cour_comp_route as cpr,tbl_country as cntry WHERE cpr.cntry_id = cntry.country_id AND cpr.company_id = $corcompany LIMIT 1";
    $selectprincicntry =  $Corpoclients->selectCorpoClient($query);
    if ($selectprincicntry) { ?>

            <select name="route_code" id="route_code2" required class="route_code2forrouted form-control selectpicker" data-show-subtext="true" data-live-search="true">
                    <option value="">Select Route</option>
                    <?php 
                        $selectroute = "SELECT route_code FROM tbl_route WHERE status=1 ORDER BY route_code ASC";
                             $execroute =  $Corpoclients->selectCorpoClient($selectroute);
                    while ($findroute=$execroute->fetch_assoc()) { ?>
                        <option id="dd" value="<?php echo $findroute['route_code']; ?>"><?php echo $findroute['route_code']; ?></option>
                    <?php }?>
            </select>
                
    <?php }else{ ?>

            <select name="country" required id="princicnty" class="form-control selectpicker cntryselctforsrch" data-show-subtext="true" data-live-search="true">
                    <option value="">Select Country</option>
                    <?php 
                        //$selectcountry = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
                          // $selectcountry = "SELECT * FROM `tbl_country` as cn WHERE NOT EXISTS( SELECT cntry_id FROM tbl_cour_comp_route as cmp WHERE cn.country_id=cmp.cntry_id AND cmp.company_id=$corcompany)";
                           // $selectcountry = "SELECT * FROM `tbl_country` as cn WHERE NOT EXISTS( SELECT cntry_id FROM tbl_cour_comp_route as cmp WHERE cn.country_id=cmp.cntry_id AND cmp.company_id=$corcompany OR (SELECT country_id FROM tbl_principal_price as pp WHERE cn.country_id=pp.country_id AND pp.cour_company=$corcompany))";                           

                           $selectcountry = "SELECT * FROM `tbl_country` as cn WHERE NOT EXISTS( SELECT cntry_id FROM tbl_cour_comp_route as cmp WHERE cn.country_id=cmp.cntry_id AND cmp.company_id=$corcompany)";

                            $execcountry =  $Corpoclients->selectCorpoClient($selectcountry);
                    while ($findcountry=$execcountry->fetch_assoc()) { ?>
                        <option id="cntryforprice" value="<?php echo $findcountry['country_id']; ?>"><?php echo $findcountry['country_name']; ?></option>
                    <?php }?>
            </select>

    <?php }

}


}





//SERCH COUNTRY FOR principal ROUTE

if ($_POST['action'] == 'srchprincicntryforroute') {

    $corcompany = $_POST['courcomp4'];
    $route_code = $_POST['route_code4'];
    if (empty($corcompany)) {

        echo "Please Select Company";

    }elseif(empty($route_code)){ 

        echo "Please Select Route";

    }else{ ?>
                <select name="country" required id="princicnty" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                        <option value="">--</option>
                        <?php 
                             echo $selectcountry = "SELECT * FROM `tbl_country` as cn WHERE NOT EXISTS( SELECT cntry_id FROM tbl_cour_comp_route as cmp WHERE cn.country_id=cmp.cntry_id AND cmp.company_id=$corcompany)";
                                 $execcountry =  $Corpoclients->selectCorpoClient($selectcountry);
                        while ($findcountry=$execcountry->fetch_assoc()) { ?>
                            <option  value="<?php echo $findcountry['country_id']; ?>"><?php echo $findcountry['country_name']; ?></option>
                        <?php }?>

                </select>



<?php } }