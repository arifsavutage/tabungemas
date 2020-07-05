SET @sql_dinamis = (SELECT GROUP_CONCAT( DISTINCT CONCAT('SUM(IF(MONTH(tb_titipan_emas_detail.periode) =',MONTH(tb_titipan_emas_detail.periode),',tb_titipan_emas_detail.profit_persen,0)) AS BLN_',DATE_FORMAT(tb_titipan_emas_detail.periode, '%M'))) FROM tb_titipan_emas_detail WHERE tb_titipan_emas_detail.periode BETWEEN '2020-06-01' AND '2020-06-30');

SET @sql = CONCAT('SELECT tb_titipan_emas.idted, tb_agt_ted.nama_lengkap, tb_titipan_emas.tgl_ikut, tb_titipan_emas.tgl_berakhir, tb_titipan_emas.tenor, tb_titipan_emas.gram, tb_titipan_emas.harga_ikut,', @sql_dinamis ,', tb_titipan_emas.status FROM tb_titipan_emas, tb_titipan_emas_detail, tb_agt_ted WHERE tb_agt_ted.idted = tb_titipan_emas.idted AND tb_titipan_emas.idx = tb_titipan_emas_detail.id_titipan GROUP BY tb_titipan_emas_detail.id_titipan WITH ROLLUP');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;