<?php
 namespace some/namespace;
 class visitation_reports extends connection
 {

 private $id;
public function id($id)  {$this->id = $id;
}

 private $did;
public function did($did)  {$this->did = $did;
}

 private $pid;
public function pid($pid)  {$this->pid = $pid;
}

 private $heatlh_status;
public function heatlh_status($heatlh_status)  {$this->heatlh_status = $heatlh_status;
}

 private $status;
public function status($status)  {$this->status = $status;
}

 private $progress_notes;
public function progress_notes($progress_notes)  {$this->progress_notes = $progress_notes;
}

 private $apt_date;
public function apt_date($apt_date)  {$this->apt_date = $apt_date;
}
public function create($data)  {$sql= "";
$q = $this->conn->prepare($sql);
$q->execute();
return 1;
}
public function read()  {$sql= "";
$q = $this->conn->prepare($sql);
$q->execute();
$r = $q->getechAll(\PDO::FETCH_ASSOC);
return $r;
}
public function update($data)  {$sql= "";
$q = $this->conn->prepare($sql);
$q->execute();
return 1;
}
public function delete($data)  {$sql= "";
$q = $this->conn->prepare($sql);
$q->execute();
return $r;
}
 }
?>
