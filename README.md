# Online Store Website that manages inventory and orders for KMS Tools Store. 

The website is built using PHP and interacts with a MySQL database through a REST API. It allows customers to browse, reserve, and request transfer orders from the store branch without the need to be physically present in the store. Admins and sales associates can access and update the system to keep inventory and orders up to date.

## Features:
* Customer Features:
  - Browse products available in the store.
  - Reserve products for future purchase.
  - Request transfer orders from the store branch.

* Admin/Sales Associate Features:
  - Manage product inventory.
  - Fulfill customer orders.
  - Update stock levels.
  - Handle transfer orders.

## API Overview:
The REST API provided in this repository allows interactions with the Online Store system. It can be accessed by customers and admins/sales associates through a web browser. The API enables developers to act on behalf of either the Admin or the Customer. The website implementation uses a PHP cURL HTML implementation of the KMS TOOLS REST API to interact with the KMS SQL Database.
