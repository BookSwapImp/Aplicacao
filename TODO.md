# TODO: Implement BuscaDAO Search Mapping

- [x] Update constructor to establish PDO connection using Connection::getConn()
- [x] Implement buscaOnlyUser method: SELECT from usuarios where nome LIKE %busca%, map to Usuario objects
- [x] Implement buscaOnlyAnuncio method: SELECT from anuncios where nome_livro LIKE %busca% and status='ativo', map to Anuncio objects
- [x] Implement busca method: Combine results from buscaOnlyUser and buscaOnlyAnuncio, return merged array
- [x] Implement mapBuscaUser: Map query results to Usuario objects
- [x] Implement mapBuscaAnuncio: Map query results to Anuncio objects
- [x] Ensure all queries use prepared statements with bindValue for security
