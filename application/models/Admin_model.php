<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_password() {
        $this->db->select("admin_password");
        return $this->db->get("admin")->result()[0];
    }

    function insertPost($data)
	{
		$insertData = array(
				"id" => $data["id"],
				"judul" => $data["judul"],
				"isi" => $data["isi"],
				"tanggal" => $data["tanggal"],
				"jumlah_gambar" => $data["jumlahgambar"]
		);
		
		$this->db->insert("blogpost", $insertData);
	}
	
	function insertBarang($data)
	{
		$insertData = array(
				"id" => $data["id"],
				"judul" => $data["judul"],
				"isi" => $data["isi"],
				"tanggal" => $data["tanggal"],
				"keterangan" => $data["keterangan"],
				"jumlah_gambar" => $data["jumlahgambar"]
		);
		
		$this->db->insert("blogpost", $insertData);
	}
	
	function updateBarang($data)
	{
		$updateData = array(
				"nama" => $data["nama"],
				"url" => $data["url"],
				"series_id" => $data["series_id"],
				"harga" => $data["harga"],
				"jumlah_gambar" => $data["jumlah_gambar"],
		);
		$this->db->where("id", $data["id"]);
		$this->db->update("barang", $updateData);
	}
	
	function deleteBarang($id)
	{
		$this->db->delete('barang',array('id' => $id));
	}
	
	function insertSeries($data)
	{
		$insertData = array(
				"id" => $data["id"],
				"nama" => $data["nama"]
		);
		
		$this->db->insert("series", $insertData);
	}
	
	function getAllSeries()
	{
		$this->db->select('*');
		$this->db->from('series');
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getCountBarang()
	{
		$this->db->select('count(id) as getcount');
		$this->db->from('barang');
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getCountPost()
	{
		$this->db->select('count(id) as getcount');
		$this->db->from('blogpost');
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getCountSeries()
	{
		$this->db->select('count(id) as getcount');
		$this->db->from('series');
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getCountConfirm()
	{
		$this->db->select('COUNT(hjual_id) AS getcount');
		$this->db->from('hjual');
		$this->db->where("hjual_status", 2);
		$query=$this->db->get()->result();
		return $query;
	}
	
	function updateStatusOrder($id_pemesanan, $status)
	{
		$updateData = array(
			"status" => $status
		);
		$this->db->where("id_pemesanan", $id_pemesanan);
		$this->db->update("hpemesanan", $updateData);
	}
	
	function setHPemesananDelivered($id_pemesanan)
	{
		$updateData = array(
			"status" => "delivered"
		);
		$this->db->set("tanggal_delivered", "NOW()", FALSE);
		$this->db->where("id_pemesanan", $id_pemesanan);
		$this->db->update("hpemesanan", $updateData);
	}
	
	function getNeedConfirmCount()
	{
		$this->db->select('count(*) as total');
		$this->db->from('hpemesanan');
		$this->db->where("status", "waiting confirmation");
		return $this->db->get()->result();
	}
	
	function getNeedConfirm($data)
	{
		$this->db->select('p.*, h.total as total');
		$this->db->from('hpemesanan h, pembayaran p');
		$this->db->where("p.id_pemesanan = h.id_pemesanan");
		$this->db->where("h.status","waiting confirmation");
		$this->db->order_by("h.tanggal_create", "asc");
		$this->db->limit($data["limit"], $data["offset"]);
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getOrderListfromUser($username)
	{
		$this->db->select('*');
		$this->db->from('hpemesanan');
		$this->db->where("username",$username);
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getDPemesananById_admin($id_pemesanan)
	{
		$this->db->select('*');
		$this->db->from('dpemesanan');
		$this->db->where("id_pemesanan",$id_pemesanan);
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getHPemesananById_admin($id_pemesanan)
	{
		$this->db->select("h.*, k.nama as nama_kota, k.province_nama as nama_provinsi");
		$this->db->from("hpemesanan h, kota k");
		$this->db->where("h.kota_id = k.id");
		$this->db->where("h.id_pemesanan", $id_pemesanan);
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	function getHJualByUsername($username)
	{
		$this->db->where("username", $username);
		$this->db->limit(1);
		return $this->db->get("hjual")->result();
	}
	
	function getLaporanBulanan($data)
	{
		$this->db->select('*');
		$this->db->from('hjual');
		$this->db->where("tanggal_create >= '" . $data["dateFrom"] . "'");
		$this->db->where("tanggal_create <= '" . $data["dateTo"] . "'");
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getSumHJualBulanan($data)
	{
		$this->db->select('sum(total) as grandtotal');
		$this->db->from('hjual');
		$this->db->where("tanggal_create >= '" . $data["dateFrom"] . "'");
		$this->db->where("tanggal_create <= '" . $data["dateTo"] . "'");
		$query=$this->db->get()->result();
		return $query;
	}
	
	function getStatistikBestSellerBulan($data)
	{
		$qry = "SELECT DISTINCT d.nama_barang AS nama, sum(d.jumlah) AS total FROM dpemesanan d, hjual h WHERE h.tanggal_create >= '" . $data["dateFrom"] . "' AND h.tanggal_create <= '" . $data["dateTo"] . "' AND h.id_pemesanan = d.id_pemesanan GROUP BY d.id_barang ORDER BY sum(d.jumlah) DESC";
		$query = $this->db->query($qry);
		return $query->result();
	}
	
	function getStatistikUkuran($data)
	{
		$qry = "SELECT DISTINCT d.size AS ukuran, sum(d.jumlah) AS total FROM dpemesanan d, hjual h where h.tanggal_create >= '" . $data["dateFrom"] . "' AND h.tanggal_create <= '" . $data["dateTo"] . "' AND h.id_pemesanan = d.id_pemesanan GROUP BY d.size";
		$query = $this->db->query($qry);
		return $query->result();
	}
	
	function getStatistikDaerah($data)
	{
		$qry = "SELECT DISTINCT k.nama as nama_kota, k.province_nama as nama_provinsi, count(h.kota_id) AS total FROM hpemesanan h, kota k where h.tanggal_create >= '" . $data["dateFrom"] . "' AND h.tanggal_create <= '" . $data["dateTo"] . "' AND h.kota_id = k.id AND h.status != 'waiting payment' GROUP BY h.kota_id ORDER BY count(h.kota_id) DESC";
		$query = $this->db->query($qry);
		return $query->result();
	}
	
	function getHPemesananByStatus($status)
	{
		$this->db->select("h.*, k.nama as nama_kota");
		$this->db->from("hpemesanan h, kota k");
		$this->db->where("h.kota_id = k.id");
		$this->db->where("h.status", $status);
		return $this->db->get()->result();
	}
	
	function HPemesananToHJual($id, $username, $total, $shipping_cost)
	{
		$insertData = array(
				"id_pemesanan" => $id,
				"username" => $username,
				"total" => $total,
				"shipping_cost" => $shipping_cost
		);
		
		$this->db->insert("hjual", $insertData);
	}
	
	function insertNoResi($id_pemesanan, $noresi)
	{
		$updateData = array(
			"nomor_resi" => $noresi,
			"status" => "shipping"
		);
		$this->db->set("tanggal_shipping", "NOW()", FALSE);
		$this->db->where("id_pemesanan", $id_pemesanan);
		$this->db->update("hpemesanan", $updateData);
	}
	//--------------------------------------------
	//--------------------------------------------
	function getAllBarang()
	{
		$this->db->select("b.*, s.nama as series");
		$this->db->from("barang b, series s");
		$this->db->where("b.series_id = s.id");
		$this->db->order_by("id", "desc");
		return $this->db->get()->result();
	}
	
	function getBarangById($id)
	{
		$this->db->select("b.*, s.nama as series");
		$this->db->from("barang b, series s");
		$this->db->where("b.id", $id);
		$this->db->where("b.series_id = s.id");
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	function getBarangByNama($nama)
	{
		$this->db->select("b.*, s.nama as series");
		$this->db->from("barang b, series s");
		$this->db->where("b.nama", $nama);
		$this->db->where("b.series_id = s.id");
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	function getBarangByUrl($url)
	{
		$this->db->select("b.*, s.nama as series");
		$this->db->from("barang b, series s");
		$this->db->where("b.url", $url);
		$this->db->where("b.series_id = s.id");
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	function getAvailableNow()
	{
		$this->db->limit(3);
		$this->db->order_by("id", "desc");
		return $this->db->get("barang")->result();
	}
	
	function getUserByUsername($username)
	{
		$this->db->where("username", $username);
		$this->db->limit(1);
		return $this->db->get("user")->result();
	}
	
	function updateUserByUsername($data)
	{
		$updateData = array(
			"first_name" => $data["first_name"],
			"last_name" => $data["last_name"],
			"alamat" => $data["alamat"],
			"kota_id" => $data["kota_id"],
			"hp" => $data["hp"]
		);
		$this->db->where("username", $data["username"]);
		$this->db->update("user", $updateData);
	}
	
	function updateUserPasswordByUsername($data)
	{
		$updateData = array(
			"password" => $data["password"]
		);
		$this->db->where("username", $data["username"]);
		$this->db->update("user", $updateData);
	}
	
	function insertUser($data)
	{
		$insertData = array(
			"username" => $data["username"],
			"password" => $data["password"],
			"email" => $data["email"]
		);
		$this->db->insert("user", $insertData);
	}
	
	function getHCartByUsername($username)
	{
		$this->db->where("username", $username);
		$this->db->limit(1);
		return $this->db->get("hcart")->result();
	}
	
	function insertHCart($data)
	{
		$insertData = array(
			"username" => $data["username"],
			"total" => $data["total"],
			"total_qty" => $data["total_qty"]
		);
		$this->db->insert("hcart", $insertData);
	}
	
	function updateHCart($data)
	{
		$updateData = array(
			"total" => $data["total"],
			"total_qty" => $data["total_qty"]
		);
		$this->db->where("username", $data["username"]);
		$this->db->update("hcart", $updateData);
	}
	
	function deleteHCartByUsername($username)
	{
		$this->db->where("username", $username);
		$this->db->delete("hcart");
	}
	
	function getDCartByUsername($username)
	{
		$this->db->select("*");
		$this->db->from("dcart");
		$this->db->where("username", $username);
		return $this->db->get()->result();
	}
	
	function getDCartById($id)
	{
		$this->db->where("id", $id);
		$this->db->limit(1);
		return $this->db->get("dcart")->result();
	}
	
	function getDCartByUsernameId($data)
	{
		$this->db->where("username", $data["username"]);
		$this->db->where("id_barang", $data["id_barang"]);
		return $this->db->get("dcart")->result();
	}
	
	function getDCartByUsernameIdSize($data)
	{
		$this->db->where("username", $data["username"]);
		$this->db->where("id_barang", $data["id_barang"]);
		$this->db->where("size", $data["size"]);
		$this->db->limit(1);
		return $this->db->get("dcart")->result();
	}
	
	function insertDCart($data)
	{
		$insertData = array(
			"id" => $data["id"],
			"username" => $data["username"],
			"id_barang" => $data["id_barang"],
			"nama" => $data["nama"],
			"size" => $data["size"],
			"harga" => $data["harga"],
			"jumlah" => $data["jumlah"],
			"subtotal" => $data["subtotal"]
		);
		$this->db->insert("dcart", $insertData);
	}
	
	function updateDCart($data)
	{
		$updateData = array(
			"harga" => $data["harga"],
			"jumlah" => $data["jumlah"],
			"subtotal" => $data["subtotal"]
		);
		$this->db->where("id", $data["id"]);
		$this->db->update("dcart", $updateData);
	}
	
	function updateDCartSize($data)
	{
		$updateData = array(
			"size" => $data["size"]
		);
		$this->db->where("id", $data["id"]);
		$this->db->update("dcart", $updateData);
	}
	
	function deleteDCartById($data)
	{
		$this->db->where("id", $data["id"]);
		$this->db->delete("dcart");
	}
	
	function deleteDCartByUsername($username)
	{
		$this->db->where("username", $username);
		$this->db->delete("dcart");
	}
	
	function getAllKaos()
	{
		return $this->db->get("kaos")->result();
	}
	
	function getAllDesign()
	{
		return $this->db->get("design")->result();
	}
	
	function getDesignName()
	{
		$this->db->group_by("nama");
		return $this->db->get("design")->result();
	}
	
	function getDesignById($id)
	{
		$this->db->where("id", $id);
		$this->db->limit(1);
		return $this->db->get("design")->result();
	}
	
	function getCustomDetail()
	{
		return $this->db->get("custom_detail")->result();
	}
	
	function getCustomDetailById($id)
	{
		$this->db->where("id", $id);
		$this->db->limit(1);
		return $this->db->get("custom_detail")->result();
	}
	
	function getCustomDetailByUserKaosDesign($data)
	{
		$this->db->where("user", $data["user"]);
		$this->db->where("kaos_id", $data["kaos_id"]);
		$this->db->where("design_id", $data["design_id"]);
		$this->db->limit(1);
		return $this->db->get("custom_detail")->result();
	}
	
	function insertCustomDetail($data)
	{
		$insertData = array(
				"id" => $data["id"],
				"user" => $data["user"],
				"kaos_id" => $data["kaos_id"],
				"design_id" => $data["design_id"],
				"harga" => $data["harga"]
		);
		$this->db->insert("custom_detail", $insertData);
	}
	
	function deleteCustomDetail($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("custom_detail");
	}

	function getAllKota()
	{
		return $this->db->get("kota")->result();
	}
	
	function getKotaById($id)
	{
		$this->db->where("id", $id);
		$this->db->limit(1);
		return $this->db->get("kota")->result();
	}
	
	function getHPemesananById($id)
	{
		$this->db->where("id_pemesanan", $id);
		$this->db->limit(1);
		return $this->db->get("hpemesanan")->result();
	}
	
	function getHPemesananByUsername($username)
	{
		$this->db->select("h.*, k.nama as nama_kota");
		$this->db->from("hpemesanan h, kota k");
		$this->db->where("h.kota_id = k.id");
		$this->db->where("h.username", $username);
		return $this->db->get()->result();
	}
	
	function getHPemesananIdByIdUsername($data)
	{
		$this->db->select("h.*, k.nama as nama_kota");
		$this->db->from("hpemesanan h, kota k");
		$this->db->where("h.kota_id = k.id");
		$this->db->where("id_pemesanan", $data["id_pemesanan"]);
		$this->db->where("username", $data["username"]);
		$this->db->where("nomor_resi IS NULL");
		return $this->db->get()->result();
	}
	
	function insertHPemesanan($data)
	{
		$insertData = array(
			"id_pemesanan" => $data["id_pemesanan"],
			"username" => $data["username"],
			"first_name" => $data["first_name"],
			"last_name" => $data["last_name"],
			"kota_id" => $data["kota_id"],
			"alamat" => $data["alamat"],
			"hp" => $data["hp"],
			"total" => $data["total"]
		);
		$this->db->insert("hpemesanan", $insertData);
	}
	
	function updateHPemesananStatusById($data)
	{
		$this->db->where("id_pemesanan", $data["id_pemesanan"]);
		$updateData = array(
			"status" => $data["status"]
		);
		$this->db->set('last_updated', 'NOW()', FALSE);
		$this->db->update("hpemesanan", $updateData);
	}
	
	function getDPemesananByIdPemesanan($id_pemesanan)
	{
		$this->db->where("id_pemesanan", $id_pemesanan);
		return $this->db->get("dpemesanan")->result();
	}
	
	function insertDPemesanan($data)
	{
		$insertData = array(
			"id" => $data["id"],
			"id_pemesanan" => $data["id_pemesanan"],
			"id_barang" => $data["id_barang"],
			"nama_barang" => $data["nama_barang"],
			"harga" => $data["harga"],
			"size" => $data["size"],
			"jumlah" => $data["jumlah"],
			"subtotal" => $data["subtotal"]
		);
		$this->db->insert("dpemesanan", $insertData);
	}
	
	function getPembayaranById_admin($id)
	{
		$this->db->where("id_pemesanan", $id);
		$this->db->limit(1);
		return $this->db->get("pembayaran")->result();
	}
	
	function insertPembayaran($data)
	{
		$insertData = array(
			"id_pemesanan" => $data["id_pemesanan"],
			"username" => $data["username"],
			"bank" => $data["bank"],
			"no_rekening" => $data["no_rekening"],
			"atasnama" => $data["atasnama"]
		);
		
		$this->db->insert("pembayaran", $insertData);
	}
}
