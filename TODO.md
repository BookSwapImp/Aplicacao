# TODO List for Fixing PDO Foreign Key Constraint Violation

## Completed Tasks
- [x] Add deleteDenunciasByAnuncioId method in DenunciaDAO.php
- [x] Fix banirUsuario method in MantenedorController.php to delete trocas by anuncio ID before deleting each anuncio
- [x] Add excluirAnuncio method in MantenedorController.php to delete only the announcement with related trocas and denuncias
- [x] Update denunciasMantenedor.php to include "Excluir Anúncio" button if anuncio exists

## Pending Tasks
- [ ] Test the fixes to ensure no more FK errors when banning users or deleting announcements
