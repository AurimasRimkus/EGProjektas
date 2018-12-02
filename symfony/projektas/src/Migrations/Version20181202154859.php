<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181202154859 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, personalCode VARCHAR(255) NOT NULL, creditCard VARCHAR(255) NOT NULL, phoneNumber VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C82E748C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dayReports (id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, reportDate DATETIME NOT NULL, comment VARCHAR(255) NOT NULL, dayLength INT NOT NULL, INDEX IDX_604F92878C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (id INT AUTO_INCREMENT NOT NULL, employee_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, personalCode VARCHAR(255) NOT NULL, bankAccount VARCHAR(255) NOT NULL, employeeType INT NOT NULL, salary DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_BA82C3008C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotels (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, companyCode VARCHAR(255) NOT NULL, rating DOUBLE PRECISION NOT NULL, address VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E402F6259EBF0234 (companyCode), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotelNetworkReports (id INT AUTO_INCREMENT NOT NULL, reportDate DATETIME NOT NULL, comment VARCHAR(255) NOT NULL, hotel INT NOT NULL, price INT NOT NULL, userId INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, warehouse_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, expirationDate DATETIME DEFAULT NULL, amount INT NOT NULL, UNIQUE INDEX UNIQ_E11EE94D5E237E06 (name), INDEX IDX_E11EE94D5080ECDE (warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, warehouse_id INT DEFAULT NULL, amount INT NOT NULL, INDEX IDX_E52FFDEE5080ECDE (warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_items (order_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_A0B446EC8D9F6D38 (order_id), INDEX IDX_A0B446EC126F525E (item_id), PRIMARY KEY(order_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, INDEX IDX_4DA23919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE warehouses (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, contactPerson VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AFE9C2B75CECC7BE (adress), UNIQUE INDEX UNIQ_AFE9C2B7946228D3 (contactPerson), UNIQUE INDEX UNIQ_AFE9C2B73243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E748C03F15C FOREIGN KEY (employee_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE dayReports ADD CONSTRAINT FK_604F92878C03F15C FOREIGN KEY (employee_id) REFERENCES employees (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3008C03F15C FOREIGN KEY (employee_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D5080ECDE FOREIGN KEY (warehouse_id) REFERENCES warehouses (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE5080ECDE FOREIGN KEY (warehouse_id) REFERENCES warehouses (id)');
        $this->addSql('ALTER TABLE orders_items ADD CONSTRAINT FK_A0B446EC8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_items ADD CONSTRAINT FK_A0B446EC126F525E FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE warehouses ADD CONSTRAINT FK_AFE9C2B73243BB18 FOREIGN KEY (hotel_id) REFERENCES hotels (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE dayReports DROP FOREIGN KEY FK_604F92878C03F15C');
        $this->addSql('ALTER TABLE warehouses DROP FOREIGN KEY FK_AFE9C2B73243BB18');
        $this->addSql('ALTER TABLE orders_items DROP FOREIGN KEY FK_A0B446EC126F525E');
        $this->addSql('ALTER TABLE orders_items DROP FOREIGN KEY FK_A0B446EC8D9F6D38');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E748C03F15C');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3008C03F15C');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94D5080ECDE');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE5080ECDE');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE dayReports');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE hotels');
        $this->addSql('DROP TABLE hotelNetworkReports');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_items');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE warehouses');
    }
}
