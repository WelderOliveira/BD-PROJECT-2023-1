<?php

namespace App\Models;

use App\Constantes\Conexoes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DenunciasModel extends Model
{
    use HasFactory;

    /**
     * @param array $values
     * @return string
     * @throws \Throwable
     */
    public static function createDenuncia(array $values): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();

        try {
            $query = "INSERT INTO tb_denuncia
                        (descricao, fk_avaliacao)
                        VALUES (?,?)";

            $db->statement($query, $values);
            $db->commit();

            return 'Denuncia cadastrada com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param array $filter
     * @return array
     */
    public static function getAllDenuncia(array $filter = []): array
    {
        $query = 'SELECT * FROM vw_denuncias WHERE 1 = 1';

        if (isset($filtro['id_user']) && !empty($id_user = $filter['id_user'])) {
            $query .= " AND id_user = '$id_user'";
        }

        if (isset($filter['id_turma']) && !empty($id_turma = $filter['id_turma'])) {
            $query .= " AND id_turma = '$id_turma'";
        }

        return DB::select($query);
    }
}
