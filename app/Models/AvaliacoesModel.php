<?php

namespace App\Models;

use App\Constantes\Conexoes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class AvaliacoesModel extends Model
{
    use HasFactory;

    /**
     * @param $filter
     * @return array
     */
    public static function getAvaliacoes($filter = []): array
    {
        $query = 'SELECT * FROM vw_avaliacao WHERE 1 = 1';

        if (isset($filtro['id_user']) && !empty($id_user = $filter['id_user'])) {
            $query .= " AND id_user = '$id_user'";
        }

        if (isset($filter['id_turma']) && !empty($id_turma = $filter['id_turma'])) {
            $query .= " AND id_turma = '$id_turma'";
        }

        return DB::select($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getAvaliacaoById(int $id): array
    {
        $query = "SELECT * FROM tb_avaliacao WHERE id = $id";
        return DB::select($query);
    }

    /**
     * @param array $values
     * @return string
     * @throws \Throwable
     */
    public static function createAvaliacao(array $values): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();

        try {
            $query = "INSERT INTO tb_avaliacao
                        (fk_user, fk_turma, nota, descricao, fk_professor)
                        VALUES (?,?,?,?,?)";

            $db->statement($query, $values);
            $db->commit();

            return 'Avaliação cadastrada com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param $params
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public static function updateAvaliacao($params, $id): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();

        try {
            $setClause = [];
            foreach ($params as $key => $value) {
                $setClause[] = "$key = '$value'";
            }
            $setClauseString = implode(', ', $setClause);

            $query = "UPDATE tb_avaliacao SET $setClauseString WHERE id = $id";

            $db->statement($query);
            $db->commit();

            return 'Avaliação atualizada com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public static function deleteAvaliacao($id): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();
        try {
            $query = 'DELETE FROM tb_avaliacao WHERE id = ?';

            $db->statement($query, [$id]);
            $db->commit();

            return 'Usuário excluido com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }
}
