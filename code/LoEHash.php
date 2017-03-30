<?
  	if (isset($_GET['d'], $_GET['s'], $_GET['a'], $_GET['r'])) {
		$random = $_GET['r'];
		if ($random == "false") {
			$algorithm = $_GET['a'];
			$data = $_GET['d'];
			$salt = $_GET['s'];
			if ($data == "null" && $salt != "null") {
				$data_salt = "" . $salt . "";
				$encrypted_data = "null";
				$encrypted_salt = HashAlgorithm($salt, null, $algorithm, "SALT ONLY", $random);
				$encrypted_data_salt = $encrypted_salt;
			}
			else if ($data != "null" && $salt == "null") {
				$data_salt = "" . $data . "";
				$encrypted_data = HashAlgorithm($data, null, $algorithm, "DATA ONLY", $random);
				$encrypted_salt = "null";
				$encrypted_data_salt = $encrypted_data;
			}
			else if ($data == "null" && $salt == "null") {
				$algorithm = "null";
				$data_salt = "null";
				$encrypted_data = "null";
				$encrypted_salt = "null";
				$encrypted_data_salt = "null";
			}
			else {
				$data_salt = "" . $data . "" . $salt . "";
				$encrypted_data = HashAlgorithm($data, null, $algorithm, "DATA ONLY", $random);
				$encrypted_salt = HashAlgorithm($salt, null, $algorithm, "SALT ONLY", $random);
				$encrypted_data_salt = HashAlgorithm($data_salt, null, $algorithm, null, $random);
			}
		} else if ($random == "true") {
			$algorithm = $_GET['a'];
			$data = $_GET['d'];
			$salt = $_GET['s'];
			$data_salt = "" . $data . "" . $salt . "";
			$encrypted_data = HashAlgorithm($data, null, $algorithm, "DATA ONLY", $random);
			$encrypted_salt = HashAlgorithm($salt, null, $algorithm, "SALT ONLY", $random);
			$encrypted_data_salt = HashAlgorithm($data_salt, null, $algorithm, null, $random);
		} else {
			$algorithm = "null";
			$data = "null";
			$salt = "null";
			$data_salt = "null";
			$encrypted_data = "null";
			$encrypted_salt = "null";
			$encrypted_data_salt = "null";
		}
	} else {
		$algorithm = "null";
		$data = "null";
		$salt = "null";
		$data_salt = "null";
		$encrypted_data = "null";
		$encrypted_salt = "null";
		$encrypted_data_salt = "null";
	}

	function newHash() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 24; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}

	function HashAlgorithm($data, $salt, $algorithm, $type, $random) {
		if ($random == "false") {
			switch($algorithm) {
				case "MD2":
				case "MD4":
				case "MD5":
				case "SHA1":
				case "SHA256":
				case "SHA384":
				case "SHA512":
				case "RIPEMD128":
				case "RIPEMD160":
				case "RIPEMD256":
				case "RIPEMD320":
				case "WHIRLPOOL":
				case "SNEFRU":
				case "GOST":
				case "ADLER32":
				case "CRC32":
				case "CRC32B":
				case "TIGER128,3":
				case "TIGER160,3":
				case "TIGER192,3":
				case "HAVAL128,3":
				case "HAVAL160,3":
				case "HAVAL192,3":
				case "HAVAL224,3":
				case "HAVAL256,3":
				case "TIGER128,4":
				case "TIGER160,4":
				case "TIGER192,4":
				case "HAVAL128,4":
				case "HAVAL160,4":
				case "HAVAL192,4":
				case "HAVAL224,4":
				case "HAVAL256,4":
					if (!isset($type) || $type == null) {
						$getData = $data;
						$getSalt = $salt;
						return hash_hmac($algorithm, $getData, $getSalt);	
					} else if ($type == "DATA ONLY") {
						$getData = $data;
						return hash($algorithm, $getData);
					} else if ($type == "SALT ONLY") {
						$getSalt = $salt;
						return hash($algorithm, $getSalt);
					}
				default:
					$getData = newHash();
					$getSalt = newHash();
					return hash_hmac("MD2", $getData, $getSalt);
			}
		} else if ($random == "true") {
			switch($algorithm) {
				case "MD2":
				case "MD4":
				case "MD5":
				case "SHA1":
				case "SHA256":
				case "SHA384":
				case "SHA512":
				case "RIPEMD128":
				case "RIPEMD160":
				case "RIPEMD256":
				case "RIPEMD320":
				case "WHIRLPOOL":
				case "SNEFRU":
				case "GOST":
				case "ADLER32":
				case "CRC32":
				case "CRC32B":
				case "TIGER128,3":
				case "TIGER160,3":
				case "TIGER192,3":
				case "HAVAL128,3":
				case "HAVAL160,3":
				case "HAVAL192,3":
				case "HAVAL224,3":
				case "HAVAL256,3":
				case "TIGER128,4":
				case "TIGER160,4":
				case "TIGER192,4":
				case "HAVAL128,4":
				case "HAVAL160,4":
				case "HAVAL192,4":
				case "HAVAL224,4":
				case "HAVAL256,4":
					if (!isset($type) || $type == null) {
						$getData = $data;
						$getSalt = $salt;
						return hash_hmac($algorithm, $getData, $getSalt);	
					} else if ($type == "DATA ONLY") {
						$getData = $data;
						return hash($algorithm, $getData);
					} else if ($type == "SALT ONLY") {
						$getSalt = $salt;
						return hash($algorithm, $getSalt);
					}
				default:
					$getData = newHash();
					$getSalt = newHash();
					return hash_hmac("MD2", $getData, $getSalt);
			}
		}
	}
?>

<!DOCTYPE HTML>
<html>
  <script type="text/javascript">
  		function getDataToEncrypt() {
        var isBoxChecked = document.getElementById("isBoxChecked").checked;
        var data = $("#Data").val();
        var salt = $("#Salt").val();
        var algorithm = $("#HashAlgorithm option:selected").val();
        if (isBoxChecked) {
          data = "<?php echo newHash();?>";
          salt = "<?php echo newHash();?>";
          window.location.href = "../loehash?d="+data+"&s="+salt+"&a="+algorithm+"&r=true";
        } else if (!isBoxChecked){
          if(data == null || data == "")
            data = "null";
          if(salt == null || salt == "")
            salt = "null";
          window.location.href = "../loehash?d="+data+"&s="+salt+"&a="+algorithm+"&r=false";
        }
      }
    </script>
    <body>
      <div id="encryptForm">
        <input type="text" id="Data" placeholder="Data" required>
        <input type="text" id="Salt" placeholder="Salt" required>
      </div><br>
      <select id="HashAlgorithm">
        <option disabled></option>
        <option disabled>
          ENCRYPTION TYPE
        </option>
        <option value="MD2">
          MD2
        </option>
        <option value="MD4">
          MD4
        </option>
        <option value="MD5">
          MD5
        </option>
        <option value="SHA1">
          SHA1
        </option>
        <option value="SHA256">
          SHA256
        </option>
        <option value="SHA384">
          SHA384
        </option>
        <option value="SHA512">
          SHA512
        </option>
        <option value="RIPEMD128">
          RIPEMD128
        </option>
        <option value="RIPEMD160">
          RIPEMD160
        </option>
        <option value="RIPEMD256">
          RIPEMD256
        </option>
        <option value="RIPEMD320">
          RIPEMD320
        </option>
        <option value="WHIRLPOOL">
          WHIRLPOOL
        </option>
        <option value="TIGER128,3">
          TIGER128-3
        </option>
        <option value="TIGER160,3">
          TIGER160-3
        </option>
        <option value="TIGER192,3">
          TIGER192-3
        </option>
        <option value="TIGER128,4">
          TIGER128-4
        </option>
        <option value="TIGER160,4">
          TIGER160-4
        </option>
        <option value="TIGER192,4">
          TIGER192-4
        </option>
        <option value="SNEFRU">
          SNEFRU
        </option>
        <option value="GOST">
          GOST
        </option>
        <option value="ADLER32">
          ADLER32
        </option>
        <option value="CRC32">
          CRC32
        </option>
        <option value="CRC32B">
          CRC32B
        </option>
        <option value="HAVAL128,3">
          HAVAL128-3
        </option>
        <option value="HAVAL160,3">
          HAVAL160-3
        </option>
        <option value="HAVAL192,3">
          HAVAL192-3
        </option>
        <option value="HAVAL224,3">
          HAVAL224-3
        </option>
        <option value="HAVAL256,3">
          HAVAL256-3
        </option>
        <option value="HAVAL128,4">
          HAVAL128-4
        </option>
        <option value="HAVAL160,4">
          HAVAL160-4
        </option>
        <option value="HAVAL192,4">
          HAVAL192-4
        </option>
        <option value="HAVAL224,4">
          HAVAL224-4
        </option>
        <option value="HAVAL256,4">
          HAVAL256-4
        </option>
      </select>
      <br>
      <br>
      <input onclick="javascript:disableForm()" id="isBoxChecked" type="checkbox"><b> Random encryption.</b>
      <br>
      <button onclick="javascript:getDataToEncrypt()" type="button"><b>Encrypt!</b></button>
	<div>
		<table>
			<thread>
				<tr align="left">
					<th>
						<b>Data</b>
					</th>
					<th>
						<b>Salt</b>
					</th>
					<th>
						<b>Data + Salt</b>
					</th>
				</tr>
			</thread>
			<tbody>
				<tr align="left">
					<td>
						<b><? echo $data;?></b>
					</td>
					<td>
						<b><? echo $salt;?></b>
					</td>
					<td>
						<b><? echo $data_salt;?></b>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thread>
				<tr align="left">
					<th>
						<b>Encrypted Data</b>
					</th>
				</tr>
			</thread>
			<tbody>
				<tr align="left">
					<td>
						<b><? echo $encrypted_data;?></b>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thread>
				<tr align="left">
					<th>
						<b>Encrypted Salt</b>
					</th>
				</tr>
			</thread>
			<tbody>
				<tr align="left">
					<td>
						<b><? echo $encrypted_salt;?></b>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thread>
				<tr align="left">
					<th>
						<b>Encrypted Hash</b>
					</th>
				</tr>
			</thread>
			<tbody>
				<tr align="left">
					<td>
						<b><? echo $encrypted_data_salt;?></b>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
    </body>
</html>
