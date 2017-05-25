SELECT p.cod , u.name AS usuario_env , s.setor AS setor_env, DATE_FORMAT(e.data_env,'%d/%m/%Y') AS data_env FROM proc p, setor s, users u, encaminhamento e, itens_enc i , itens_setor st 
WHERE  e.cod = i.cod_enc AND i.cod_user_env = u.id AND e.cod = st.cod_enc AND st.cod_setor_enc = s.cod_setor AND e.user_env = u.id AND e.cod_stenv = s.cod_setor AND e.cod_prenc = p.cod AND
p.cod = '58';