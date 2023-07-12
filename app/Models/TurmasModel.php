<?php

namespace App\Models;

use App\Constantes\Conexoes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class TurmasModel extends Model
{
    use HasFactory;

    /**
     * @param array $filter
     * @return array
     */
    public static function getTurmas(array $filter): array
    {
        $query = 'SELECT * FROM tb_turma WHERE 1 = 1';

        if (!empty($periodo = $filter['periodo'])) {
            $query .= " AND periodo = '$periodo'";
        }

        if (!empty($professor = $filter['professor'])) {
            $query .= " AND professor LIKE %'$professor'%";
        }

        if (!empty($horario = $filter['horario'])) {
            $query .= " AND horario LIKE %'$horario'%";
        }

        if (!empty($disciplina = $filter['disciplina'])) {
            $query .= " AND disciplina = '$disciplina'";
        }

        if (!empty($departamento = $filter['carga_horaria'])) {
            $query .= " AND carga_horaria = '$departamento'";
        }

        return DB::select($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getTurmaById(int $id): array
    {
        $query = "SELECT * FROM tb_turma WHERE id = $id";
        return DB::select($query);
    }

    /**
     * @param array $values
     * @return string
     * @throws Throwable
     */
    public static function createTurma(array $values): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();

        try {
            $query = "INSERT INTO tb_turma
                        (periodo, fk_professor, horario, vagas_ocupadas, total_vagas, local, fk_disciplina, carga_horaria)
                        VALUES (?,?,?,?,?,?,?,?)";

            $db->statement($query, $values);
            $db->commit();

            return 'Turma cadastrada com Sucesso';
        } catch (\Exception $exception) {
            $db->rollBack();
            return $exception->getMessage();
        } catch (Throwable $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @param array $params
     * @param int $id
     * @return string
     * @throws Throwable
     */
    public static function updateTurma(array $params, int $id): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();

        try {
            $setClause = [];
            foreach ($params as $key => $value) {
                $setClause[] = "$key = '$value'";
            }
            $setClauseString = implode(', ', $setClause);

            $query = "UPDATE tb_turma SET $setClauseString WHERE id = $id";

            $db->statement($query);
            $db->commit();

            return 'Turma atualizada com Sucesso';
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
     * @throws Throwable
     */
    public static function deleteTurma($id): string
    {
        $db = DB::connection(Conexoes::DB_PERSISTENCIA);
        $db->beginTransaction();
        try {
            $query = 'DELETE FROM tb_turma WHERE id = ?';

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
