SELECT p.cod , r.nome, p.tipo, p.assunto , u.name AS usuario_env , s.setor AS setor_env, DATE_FORMAT(e.data_env,'%d/%m/%Y') AS data_env, e.horas_env AS horas_env FROM proc p, req r, setor s, users u, encaminhamento e 
WHERE  r.cod = p.cod_req AND e.user_env = u.id 
AND e.cod_stenv = s.cod_setor AND e.cod_prenc = p.cod AND p.cod = '59';