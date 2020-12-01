#!/bin/zsh

# mariadb -u root --execute="USE emissary; DELETE FROM card_image";
# mariadb -u root --execute="USE emissary; DELETE FROM contact";
# mariadb -u root --execute="USE emissary; DELETE FROM rejected_contact";
# mariadb -u root --execute="USE emissary; DELETE FROM card";
# mariadb -u root --execute="USE emissary; DELETE FROM voucher";
# mariadb -u root --execute="USE emissary; DELETE FROM batch";

mariadb -u root --execute="USE emissary; TRUNCATE card_image";
mariadb -u root --execute="USE emissary; TRUNCATE contact";
mariadb -u root --execute="USE emissary; TRUNCATE rejected_contact";
mariadb -u root --execute="USE emissary; SET FOREIGN_KEY_CHECKS=0; TRUNCATE card; SET FOREIGN_KEY_CHECKS=1";
mariadb -u root --execute="USE emissary; SET FOREIGN_KEY_CHECKS=0; TRUNCATE voucher; SET FOREIGN_KEY_CHECKS=1";
mariadb -u root --execute="USE emissary; SET FOREIGN_KEY_CHECKS=0; TRUNCATE batch; SET FOREIGN_KEY_CHECKS=1";
mariadb -u root --execute="USE emissary; TRUNCATE jobs";
mariadb -u root --execute="USE emissary; TRUNCATE failed_jobs";
