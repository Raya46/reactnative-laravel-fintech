ADMIN
get siswa = /getsiswa
delete siswa = /user-admin-delete/id
create siswa = /user-admin-create
store siswa = /user-admin-store
edit siswa = /user-admin-edit/id
put siswa - /user-admin-update/id

get category = /category-admin
delete category = /category-admin-delete/id
store category = /category-admin-store
put category = /category-admin-update/id

BANK
get data bank = /bank
accept topup = /topup-success/id
withdraw bank = /withdraw-bank (must fill debit=>int/double)
withdraw to user = /withdraw (must fill users_id=>int, debit=>int/double)

KANTIN
get data kantin = /kantin
delete product = /delete-product/id
store product = /create-product
update product = /product-update/id
edit product = /product-edit/id

get transaction kantin = /transaction-kantin
verifikasi pengambilan = /transaction-kantin/id

USER
get data history = /history
clear history = /history-clear
topup = /topup
get data siswa = /get-product-siswa
cancel cart = /keranjang/delete/(id)
pay product = /pay-product
get profile siswa = /profilesiswa

ALL ROLE ACCESS
get data download = /history/(order_code)
get data report = /history (siswa), /report-admin (admin), /report-bank (bank)
login = /login


