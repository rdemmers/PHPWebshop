<?php

interface iDao {

    public function add($object);

    public function delete($id);

    public function get($id);

    public function update($object);
}
