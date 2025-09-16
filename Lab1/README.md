# Hướng dẫn sử dụng — Labs 1.2.1 & 1.2.2 (PHP + MySQL + phpMyAdmin) bằng Docker

Dự án này chạy **hai lab song song** và **dùng chung CSDL** `my_guitar_shop`:
- **Lab 1.2.1 (Categories CRUD)**: http://localhost:8080
- **Lab 1.2.2 (Product Manager)**: http://localhost:8082
- **phpMyAdmin**: http://localhost:8081  (Server: `db`, User: `root`, Pass: `rootpass`)

> Lần chạy đầu, MySQL sẽ tự tạo DB/bảng và seed dữ liệu từ `db/init/*.sql`.

---

## 1) Yêu cầu
- **Docker Desktop** (Windows/macOS) hoặc **Docker Engine** + **docker compose v2** (Linux).
- Cổng trống: 8080, 8081, 8082, **3306** (hoặc bạn đổi port theo mục 5).

## 2) Chạy nhanh (Quick start)

```bash
# 1) mở terminal trong thư mục dự án
docker compose up -d

# 2) truy cập các dịch vụ
# Lab 1.2.1: http://localhost:8080
# Lab 1.2.2: http://localhost:8082
# phpMyAdmin: http://localhost:8081  (server: db)
```

**Lưu ý:** Nếu trang lab/ phpMyAdmin vừa mở đã báo lỗi DB, hãy chờ 5–10 giây cho MySQL khởi động xong rồi F5 lại.

## 3) Cấu trúc thư mục

```
.
├─ docker-compose.yml
├─ db/
│  └─ init/
│     ├─ 00_user.sql      # tạo user mgs_user/pa55word, cấp quyền hạn chế
│     ├─ 01_schema.sql    # tạo bảng categories, products (FK ON DELETE CASCADE)
│     └─ 02_data.sql      # dữ liệu mẫu
├─ web/                   # Lab 1.2.1 (port 8080)
│  ├─ Dockerfile, php.ini
│  └─ src/index.php       # CRUD categories (Create/Save/Delete + list)
└─ web-122/               # Lab 1.2.2 (port 8082)
   ├─ Dockerfile, php.ini
   └─ src/
      ├─ database.php, database_error.php, error.php
      ├─ index.php                 # liệt kê sản phẩm theo category
      ├─ add_product_form.php      # form thêm
      ├─ add_product.php           # INSERT prepared statement
      ├─ delete_product.php        # DELETE prepared statement
      └─ main.css
```

## 4) Nội dung từng lab

### Lab 1.2.1 — Categories CRUD
- **Create**: thêm `categoryName`.
- **Save (Update)**: sửa tên danh mục.
- **Delete**: xoá danh mục. Do schema bật **`ON DELETE CASCADE`**, nếu danh mục đang có sản phẩm thì MySQL sẽ tự xoá các sản phẩm con (tránh lỗi ràng buộc FK).

### Lab 1.2.2 — Product Manager
- Chọn **category** ở sidebar → liệt kê sản phẩm của category đang chọn.
- **Add Product**: nhập `category`, `productCode`, `productName`, `listPrice` → dùng `prepare()/bindValue()/execute()`.
- **Delete**: xoá theo `productID`.
- Đã xử lý lỗi **trùng `productCode`** (MySQL error 1062) → hiện thông báo thân thiện.

## 5) Đổi port khi bị trùng

### MySQL (cổng host 3306 bận)
Mở `docker-compose.yml`, sửa service `db`:
```yaml
services:
  db:
    ports:
      - "3307:3306"   # đổi 3306 -> 3307
```
> phpMyAdmin và 2 lab **không cần đổi gì** vì kết nối nội bộ tới `db:3306`.  
> Hoặc bạn có thể **bỏ hẳn** phần `ports:` của `db` nếu **chỉ** dùng qua phpMyAdmin/lab (không cần truy cập MySQL từ host).

### Web apps
Đổi các cổng web nếu cần (ví dụ 1.2.2):
```yaml
  web_122:
    ports:
      - "9082:80"     # đổi 8082 -> 9082
```

Sau khi sửa, chạy lại:
```bash
docker compose down
docker compose up -d
```

## 6) Dùng phpMyAdmin
- Mở `http://localhost:8081` → **Server**: `db` → **User**: `root` → **Pass**: `rootpass`.
- Vào DB **`my_guitar_shop`** → xem bảng **categories**, **products**.
- Tab **SQL** có thể chạy nhanh ví dụ:
```sql
-- SELECT
SELECT * FROM categories ORDER BY categoryID;

-- INSERT
INSERT INTO categories (categoryName) VALUES ('Amps');

-- UPDATE
UPDATE categories SET categoryName='Electric Guitars' WHERE categoryName='Guitars';

-- DELETE
DELETE FROM categories WHERE categoryName='Amps';
```

## 7) Reset dữ liệu (xoá volume DB)
```bash
docker compose down -v
docker compose up -d
```
> Dùng khi bạn muốn chạy lại từ đầu (re-run `db/init/*.sql`).

## 8) Khắc phục lỗi thường gặp
- **`ports are not available ... 0.0.0.0:3306`**: Cổng 3306 đang bận → đổi mapping sang `3307:3306` hoặc bỏ `ports` của `db`.  
- **Trang báo lỗi kết nối DB** khi mới `up -d`: chờ MySQL hoàn tất khởi động rồi F5.
---

### Lệnh hữu ích
```bash
# xem log
docker compose logs -f

# rebuild web nếu bạn sửa Dockerfile
docker compose build web web_122 && docker compose up -d

# vào shell của container
docker compose exec web bash
docker compose exec web_122 bash
docker compose exec db mysql -uroot -prootpass
```
