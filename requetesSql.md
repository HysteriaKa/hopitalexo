"INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`,`mail`, `phone` )
            VALUES (:lastname, :firstname , :birthdate , :mail, :phone)";

            "UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname, `birthdate`=:birthdate,`mail`=:mail, `phone`=:phone WHERE id=:id";

            SELECT id, lastname, firstname, birthdate, phone, mail FROM patients "