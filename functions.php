<?php
class functions{
    private $connect = false;
    public function __construct(){
		$conn =  mysqli_connect("localhost","root","") or die(mysqli_error($conn));
		mysqli_select_db($conn,"eshop") or die(mysqli_error($conn));
		$this->connect=$conn;
	}
    private function getData($req){
        $res = mysqli_query($this->connect,$req);
        if(!$res){
            //die('Error in query : '. mysqli_error($this->connect));
            
        }
        
        $data= array();
        while ($row = mysqli_fetch_array($res)) {
			$data[]=$row;            
		}
		return $data;
    }
    private function setData($req){
        $res = mysqli_query($this->connect,$req);
        if(!$res){
            die('Error in query : '. mysqli_error($this->connect));
        }
    }
    public function listProduct(){
        $query = "select * from produit";
        return $this->getData($query);
    }
    public function addProduct($id,$name,$price,$desc,$categ,$stock){
        $query="insert into produit (id,nom_p,prix_p,desc_p,categ_p,stock)
                values('$id','$name','$price','$desc','$categ','$stock')";
        return $this->setData($query);
    }
    public function deleteProduct($id){
        $query= "delete from produit where id=$id";
        return $this->getData($query);
    }
    public function modifyProduct($id,$name,$price,$desc,$categ,$stock){
        $query="update produit set nom_p='$name', prix_p='$price', desc_p='$desc', categ_p='$categ', stock=$stock
                where id='$id'";
        return $this->setData($query);    
    }
    public function listClient(){
        $query="select * from client where role='client'";
        return $this->getData($query);
    }
    public function listDelivry(){
        $query="select * from client where role= 'delivry'";
        return $this->getData($query);
    }
    public function addAccount($email,$name,$role,$password,$lastname,$address,$tel){
        $query="insert into client (email,name,role,password,lastname,address,tel)
                values('$email','$name','$role','$password','$lastname','$address','$tel')";
        return $this->setData($query);
    }
    public function deleteAccount($id){
        $query="delete from client where email='$id'";
        return $this->getData($query);
    }
    public function modifyAccount($email,$name,$role,$password,$lastname,$address,$tel){
        $query="update client set name=$name,role=$role,lastname=$lastname,address=$address,tel=$tel where email=$email";
        return $this->setData($query);
    }
    public function listNewCommand(){
        $query="select * from commands where delivryEmail is null and delivred is null";
        return $this->getData($query);
    }
    public function listNotDelivred(){
        $query="select * from commands where delivryEmail is not null and delivred is null";
        return $this->getData($query);
    }
    public function listHistory(){
        $query="select * from commands where delivred is not null";
        return $this->getData($query);
    }
    public function acceptOrder($id,$email){
        $query="update commands set accepted='true', delivryEmail= '$email' where id=$id";
        return $this->setData($query);
    }
    public function getProcutById($id){
        $query="select * from produit where id=$id";
        return $this->getData($query);
    }
    public function getClientById($id){
        $query="select * from client where email='$id'";
        return $this->getData($query);
    }
    public function listCategory(){
        $query="select * from categorie";
        return $this->getData($query);
    }
    public function getcategById($id){
        $query="select * from produit where id=$id";
        return $this->getData($query);
    }
    public function selectMax($table){
        $query="select max(id) from $table";
        return $this->getData($query);
    }
    public function addContact($email,$message){
        $query="insert into contact (email,message)
                values('$email','$message')";
        return $this->setData($query);
    }
    public function getProdShoppingCartById($id,$email,$list){
        $query="select * from shoppingCart where prodId='$id' and email='$email' and list='$list'";
        return $this->getData($query);
    }
    public function addToShoppingCart($id,$email,$list){
        $query="insert into shoppingCart (email,prodId,list) values('$email','$id','$list')";
        return $this->setData($query);
    }
    public function prodShoppingCartList($email,$list){
        $query="select * from produit p join shoppingCart b on (p.id=b.prodId) where b.email='$email' and list='$list'";
        return $this->getData($query);
    }
    public function remouveFromShoppingCart($id,$email,$list){
        $query="delete from shoppingCart where prodId= $id and list='$list' and email= '$email' ";
        return $this->getData($query);
    }
    public function countShoppingCart($email,$list){
        $query="select count(*) from shoppingCart where email='$email' and list='$list'";
        return $this->getData($query);
    }
    public function orderItems($id,$prodid,$qte){
        $query="insert into commande_items (command_id,produit_id,quantity) values('$id','$prodid','$qte')";
        return $this->setData($query);
    }
    public function addOrder($id,$email,$location){
        $query="insert into commands (id,date_com,location,clientEmail) values('$id',DATE(NOW()),'$location','$email')";
        return $this->setData($query);
    }
    public function totalPrice($id){
        $query="select sum(prix_p*quantity) as total from produit p join commande_items ci on(p.id=ci.produit_id) where ci.command_id=$id ";
        return $this->getData($query);
    }
    public function detailOrder($id){
        $query="select id,nom_p,prix_p,quantity from produit p join commande_items ci on(p.id=ci.produit_id) where ci.command_id=$id ";
        return $this->getData($query);
    }
    public function addPicture($id,$type,$data,$prodid){
        $query="insert into picture (id,type,data,prodId) values(?,?,?,?)";
        $statement = $this->connect->prepare($query);
        $statement->bind_param('ssss', $id, $type, $data, $prodid);
        return $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
    }
    public function listPicture(){
        $query="select * from picture";
        return $this->getData($query);
    }
    public function getPictureByProdId($id){
        $query="select * from picture where prodId=$id";
        return $this->getData($query);
    }
    public function modifyPicture($pictureType,$pictureData,$id){
        $query="update picture set type=?, data=? where prodId=?";
        $statement = $this->connect->prepare($query);
        $statement->bind_param('sss', $pictureType, $pictureData, $id);
        return $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
    }
    public function orderSigned($id,$sign){
        $query="update commands set delivred=$sign where id=$id";
        return $this->setData($query);
    }
    public function updateStock($prodid,$qte){
        $query="update produit set stock=(stock-$qte) where id=$prodid";
        return $this->setData($query);
    }
    public function getRating($id){
        $query="select avg(rev) from review where prodId=$id";
        return $this->getData($query);
    }
    public function updateRating($id,$email,$rate){
        $query="update review set rev='$rate' where prodId='$id' and clientEmail='$email'";
        return $this->setData($query);
    }
    public function countNewOrder(){
        $query="select count(*) from commands where delivryEmail is null";
        return $this->getData($query);
    }
    public function existRating($id,$email){
        $query="select * from review where prodId='$id' and clientEmail='$email'";
        return $this->getData($query);
    }
    public function addRating($id,$email,$rate){
        $query="insert into review values ('$id','$email','$rate')";
        return $this->setData($query);
    }
    public function deleteCommand($id){
        $query="delete from commands where id = $id";
        return $this->getData($query);
    }
    public function getOrderItems($id){
        $query="select * from commande_items where command_id='$id'";
        return $this->getData($query);
    }
    public function addToStock($id,$qte){
        $query="update produit set stock=$qte where id=$id";
        return $this->setData($query);
    }
    public function addCategory($id,$name){
        $query="insert into categorie values($id,$name)";
        return $this->setData($query);
    }
    public function getDiscount($id){
        $query="select * from discount where id=$id";
        return $this->getData($query);
    }
    public function updateDiscount($id,$date_end,$discount){
        $query="update discount set date_end='$date_end', percentage=$discount where id=$id";
        return $this->setData($query);
    }
    public function addDiscount($id,$date_end,$discount){
        $query="INSERT INTO `discount`(`Id`, `date_deb`, `date_end`, `percentage`) VALUES ($id,now(),'$date_end',$discount)";
      //  $query="insert into discount (id,date_deb,date_end,percentage)
        return $this->setData($query);
    }
    public function addDiscountToProd($id,$disId){
        $query="update produit set discount=$disId where id=$id";
        return $this->setData($query);
    }
    public function maxDsId(){
        $query="select max(id) from discount";
        return $this->getData($query);
    }
    public function totalPrice2($email){
        $query="select sum(prix_p) as total from produit , shoppingcart where produit.id=shoppingcart.prodId and shoppingcart.email='$email'and list='cart'";
        return $this->getData($query);
    }
}
?>