<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css
    " rel="stylesheet">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
</head>

<body>
    <p>พูมมี่สุดสวย</p>
    <div class="container mt-3">
        <h2>ToDo ToJai</h2>
        <div class="d-flex justify-content-end ">
             <button class="btn btn-primary" onclick="addTodo()">Add ToDo</button>
        </div>

        <table class="table table-striped">

            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อ</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col">การกระทำ</th>
                </tr>
            </thead>
            <tbody>

                @if ($todo_lists !== null)
                @foreach ($todo_lists as $index => $todo_list)
                <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$todo_list->td_name}}</td>
                    <td>
                        @if ($todo_list->td_status === 0)
                        ยังไม่ทำค่าา
                        @else
                        ทำล้าา
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        <div style="cursor: pointer"> ✅</div>
                        <div style="cursor: pointer" onclick="editTodo({{$todo_list->td_id}})">🖋️</div>
                        <div style="cursor: pointer" onclick="deleteTodo({{$todo_list->td_id}})" >🗑️</div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">ไม่มีจ้า</td>
                </tr>
                @endif

            </tbody>

        </table>

    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    const addTodo = () => {
        Swal.fire({
            title: "กรุณากรอกข้อมูล",
            html: '<input id="title" placeholder ="หัวข้อ" class="swal2-input">' +
                '<input id="des" placeholder ="คำอธิบาย" class="swal2-input">',

            showCancelButton: true,
            confirmButtonText: "สร้าง",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    //ดึงค่า
                    const title = document.getElementById("title").value;
                    const des = document.getElementById("des").value;
                    //ส่ง req
                    const response = await fetch('/todo', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            title,
                            des
                        })
                    });
                    //ถ้า err
                } catch (error) {
                    Swal.fire({
                        icon: "error",
                        title: `เกิดข้อผิดพลาด`,
                    });
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: "success",
                    title: `สำเร็จ`,
                });

                window.location.reload();
            }
        });

    }

    const deleteTodo = async (td_id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(async (result) => {
            if (result.isConfirmed) {
                const response = await fetch(`/todo/${td_id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });
                if (response.status === 200) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    window.location.reload();
                }
            }
        });
    }

 const editTodo = async(td_id) =>{
        Swal.fire({
            title: "แก้ไข",
            html:
            '<input id="title" placeholder ="หัวข้อ" class="swal2-input">' +
            '<input id="des" placeholder ="คำอธิบาย" class="swal2-input">',

            showCancelButton: true,
            confirmButtonText: "สร้าง",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
              try {
                 //ดึงค่า
                 const name = document.getElementById("title").value;
                 const des = document.getElementById("des").value;
                 //ส่ง req
                 const response = await fetch(`/todo/${td_id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, des })
                  });
                //ถ้า err
              } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: `เกิดข้อผิดพลาด`,
                  });
              }
            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                icon: "success",
                title: `สำเร็จ`,
              });

              window.location.reload();
            }
          });

    }

</script>

</html>


