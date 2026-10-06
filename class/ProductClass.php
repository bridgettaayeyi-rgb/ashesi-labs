<?php
require_once __DIR__ . '/../core/db_class.php';

class ProductClass extends Database {

    // for brands
    public function addBrand($name) {
        $stmt = $this->conn->prepare("INSERT INTO brands (brand_name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function getAllBrands() {
        $stmt = $this->conn->prepare("SELECT * FROM brands ORDER BY brand_name ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $brands = [];
        while ($row = $result->fetch_assoc()) {
            $brands[] = $row;
        }
        $stmt->close();
        return $brands;
    }

    public function getBrandById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM brands WHERE brand_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row ? $row : false;
    }

    public function updateBrand($id, $name) {
        $stmt = $this->conn->prepare("UPDATE brands SET brand_name = ? WHERE brand_id = ?");
        $stmt->bind_param("si", $name, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function deleteBrand($id) {
        $stmt = $this->conn->prepare("DELETE FROM brands WHERE brand_id = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    // ========== CATEGORIES ==========
public function addCategory($name) {
    $stmt = $this->conn->prepare("INSERT INTO categories (cat_name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

public function getAllCategories() {
    $stmt = $this->conn->prepare("SELECT * FROM categories ORDER BY cat_name ASC");
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    $stmt->close();
    return $categories;
}

public function getCategoryById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM categories WHERE cat_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row ? $row : false;
}

public function updateCategory($id, $name) {
    $stmt = $this->conn->prepare("UPDATE categories SET cat_name = ? WHERE cat_id = ?");
    $stmt->bind_param("si", $name, $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

public function deleteCategory($id) {
    $stmt = $this->conn->prepare("DELETE FROM categories WHERE cat_id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

}
