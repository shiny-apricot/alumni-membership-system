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


def fetch_excel_rows(foldername):
    print('#####', os.getcwd())
    directory = os.path.join(os.getcwd(), foldername)
    print('#####', directory)
    df = pd.read_excel(directory)
    # check if there is a null value
    isna = pd.isna(df)
    # initialize lists
    year_list, kalan_list, borc_list = initialize_lists()
    # start FOR over the rows
    for index, row in df.iterrows():
        if isna.at[index, 'AD'] == False:
            print('bos degil => ', df.at[index, 'ÜYE NO'])
            for column in df:
                if 'BORÇ' in column:
                    if isna.at[index, column] == False:
                        column_value = df.at[index, column]
                        column = column.strip()
                        year = column[-4:]
                        # print("value = ", column, " ", column_value)
                        # print('yil = ', year)
                        borc_list[int(year) - 2005] = column_value
                if 'KALAN' in column:
                    if isna.at[index, column] == False:
                        column_value = df.at[index, column]
                        column = column.strip()
                        year = column[-4:]
                        # print("value = ", column, " ", column_value)
                        # print('yil = ', year)
                        kalan_list[int(year) - 2005] = column_value

            cinsiyet = str(df.iat[index, 1]).strip().lower()
            ad = str(df.iat[index, 2]).lower()
            soyad = str(df.iat[index, 3]).strip().lower()
            workplace = str(df.iat[index, 4]).lower()
            mail = str(df.iat[index, 5]).strip().lower()
            tc_no = str(df.iat[index, 6]).strip().lower()
            grad_date = df.iat[index, 7]
            department = str(df.iat[index, 8]).lower()
            phone = str(df.iat[index, 9])
            adress = str(df.iat[index, 10]).lower()
            il = str(df.iat[index, 11]).strip().lower()
            # print('borc', borc)
            # print('kalan', kalan)
            list_of_tuples = list(zip(year_list, borc_list, kalan_list))
            frame = pd.DataFrame(list_of_tuples,
                                columns=['year', 'borc', 'kalan'])
            # print(frame)
            year_list, kalan_list, borc_list = initialize_lists()
            for index, row in frame.iterrows():
                borc = frame.at[index,'borc']
                kalan = frame.at[index,'kalan']
                if borc != 0 or kalan != 0:
                    year = frame.at[index, 'year']
                    # print('insert into member (gender, name, surname, workplace, email, tc_no, grad_date, department, '
                    #       'phone, address, province ) '
                    #       ' VALUES ()')
                    print('insert into member= ',ad)
                    print('insert into fee_condition year= ',year,' borc= ',borc,' kalan= ',kalan)

    # print(df.at[index,'ÜYE NO'])

    # print(index, " ##")
