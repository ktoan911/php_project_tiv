<?php
    function transfer($pdo, $from, $to, $amount) {
        try{
            $pdo->beginTransaction();

            $sql = "SELECT AMOUNT FROM accounts WHERE ID = :from";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':from' => $from]);
            $availableAmount = (int) $stmt->fetchColumn(); 
            $stmt-> closeCursor();

            if ($availableAmount < $amount) {
                echo 'Insufficient funds in account';
                return false;
            }

            $sql_update_from = "UPDATE accounts SET AMOUNT = AMOUNT - :amount WHERE ID = :from";
            $stmt = $pdo->prepare($sql_update_from);
            $stmt->execute([':amount' => $amount, ':from' => $from]);
            $stmt->closeCursor();
            $sql_update_to = "UPDATE accounts SET AMOUNT = AMOUNT + :amount WHERE ID = :to";
            $stmt = $pdo->prepare($sql_update_to);
            $stmt->execute([':amount' => $amount, ':to' => $to]);
            $pdo->commit();
            echo "Transfer successful from account $from to account $to with amount $amount";
            return true;
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Transfer failed: " . $e->getMessage());
        }
    }
?>