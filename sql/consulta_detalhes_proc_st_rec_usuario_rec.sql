SELECT p.cod , u.name AS usuario_rec , s.setor AS setor_rec, DATE_FORMAT(e.data_rec,'%d/%m/%Y') AS data_rec
FROM proc p, setor s, users u, encaminhamento e, itens_enc i , itens_setor st WHERE u.id = i.cod_user_id AND e.cod = i.cod_enc
AND e.cod = st.cod_enc AND s.cod_setor = st.cod_setor AND e.user_rec = u.id AND  e.cod_stdst = s.cod_setor AND p.cod = '53';