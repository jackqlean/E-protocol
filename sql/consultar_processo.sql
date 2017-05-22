SELECT p.cod ,  r.nome, p.tipo, DATE_FORMAT(p.data,'%d/%m/%Y') AS data, p.horas ,s.setor AS setor FROM proc p, req r, setor s WHERE p.cod_req = r.cod
AND s.cod_setor = p.setor AND p.cod = '53';