import os
import pandas as pd


# print (df)

# iterating the columns
# for col in df.columns:
#     print(col)


def initialize_lists():
    year_list = list()
    kalan_list = list()
    borc_list = list()
    for x in range(2005, 2030):
        year_list.append(x)
    for x in range(0, 25):
        kalan_list.append(0)
        borc_list.append(0)
    return year_list, kalan_list, borc_list


def process_excel_rows(connection, filename):
    print('#####', os.getcwd())
    directory = os.path.join(os.getcwd(), filename)
    print('#####', directory)
    df = pd.read_excel(directory)
    # Includes 'True' if there is a null value in that cell
    isna = pd.isna(df)
    # initialize lists
    year_list, kalan_list, borc_list = initialize_lists()
    member_info = list()

    member_state = ""
    regist_date = ""
    member_explanation = ""

    # start the FOR over the rows
    for index, row in df.iterrows():
        if isna.at[index, 'AD'] == False:
            print('bos degil => ', df.at[index, 'ÜYE NO'])
            for column in df:
                if 'borç' in column.lower().strip():
                    if isna.at[index, column] == False:
                        column_value = df.at[index, column]
                        column = column.strip()
                        year = column[-4:]
                        # print("value = ", column, " ", column_value)
                        # print('yil = ', year)
                        borc_list[int(year) - 2005] = column_value
                if 'kalan' in column.lower().strip():
                    if isna.at[index, column] == False:
                        column_value = df.at[index, column]
                        column = column.strip()
                        year = column[-4:]
                        # print("value = ", column, " ", column_value)
                        # print('yil = ', year)
                        kalan_list[int(year) - 2005] = column_value
                if 'durum' in column.lower().strip():
                    if isna.at[index, column] == False:
                        member_state = df.at[index, column]
                if 'hakkinda' in column.lower():
                    if isna.at[index, column] == False:
                        member_explanation = df.at[index, column]
                if 'GİRİŞ' in column.upper():
                    if isna.at[index, column] == False:
                        regist_date = df.at[index, column]


            cinsiyet = str(df.iat[index, 1]).strip().upper()
            ad = str(df.iat[index, 2]).upper()
            soyad = str(df.iat[index, 3]).strip().upper()
            workplace = str(df.iat[index, 4]).upper()
            mail = str(df.iat[index, 5]).strip().upper()
            tc_no = str(df.iat[index, 6]).strip().upper()
            grad_date = str(df.iat[index, 7])
            department = str(df.iat[index, 8]).upper().strip()
            phone = str(df.iat[index, 9])
            adress = str(df.iat[index, 10]).upper()
            province = str(df.iat[index, 11]).strip().upper()

            regist_date = str(regist_date)

            # member_element = cinsiyet + "," + ad + "," + soyad + "," + workplace + "," + mail + "," \
            #                 + tc_no + "," + grad_date + "," + department + "," + phone + "," + adress + "," + province
            # member_element = str(member_element)

            list_of_tuples = list(zip(year_list, borc_list, kalan_list))

            frame = pd.DataFrame(list_of_tuples,
                                columns=['year', 'borc', 'kalan'])
            # print(frame)
            year_list, kalan_list, borc_list = initialize_lists()
            with connection:
                with connection.cursor() as cursor:
                    query_member = "INSERT INTO member (gender, name, surname, workplace, email, tc_no, grad_date, department, phone_number, province, member_regist_date, member_situation)" \
                        " VALUES ('"+cinsiyet+"','"+ad+"','"+soyad+"','"+workplace+"', '"+mail+"', '"+tc_no+"', '"+grad_date+"', '"+department+"', '"+phone+"', '"+province+"', '"+regist_date+"', '"+member_state+"') "
                    cursor.execute(query_member)
                    connection.commit()
                    print("INSERTED MEMBER")

                    query_member_id = "SELECT member_id FROM member WHERE name = '"+ad+"' AND surname = '"+soyad+"' AND email= '"+mail+"'"
                    cursor.execute(query_member_id)
                    member_id_tuple = cursor.fetchall()
                    member_id = member_id_tuple[0]
                    print('MEMBER ID ===', member_id)

                    # iterate through the year-debt pairs
                    for index, row in frame.iterrows():
                        borc = frame.at[index,'borc']
                        kalan = frame.at[index,'kalan']
                        if borc != 0 or kalan != 0:
                            year = frame.at[index, 'year']
                            year = str(year)
                            borc = str(borc)
                            kalan = str(kalan)
                            member_id =  ''.join(map(str, member_id))
                            # member_id = str(member_id)

                            print('insert into fee_condition member_id=> ',member_id,' year= ',year,' borc= ',borc,' kalan= ',kalan)
                            query = "INSERT INTO fee_condition (member_id, year, debt, remained) VALUES ('"+member_id+"', "+year+", "+borc+","+kalan+") ON CONFLICT DO NOTHING;"
                            cursor.execute(query)
                            connection.commit()
                                
            
 
    # print(df.at[index,'ÜYE NO'])

    # print(index, " ##")
