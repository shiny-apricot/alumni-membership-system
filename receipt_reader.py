import os
import pandas as pd
import coloredlogs, logging
import sys


print('RECEIPT READER')

def receipt_reader(filename):
    print('#####', os.getcwd())
    directory = os.path.join(os.getcwd(), filename)
    df = pd.read_excel(directory)
    # print(df)
    
    # iterating the columns
    # for col in df.columns:
    #     print(col)
    
    isNaN = pd.isna(df)
    
    date_list = list()
    tc_list = list()
    explanation_list = list()
    balance_list = list()
    fee_list = list()
    dekont_no_list = list()
    
    start_index = 0
    for index, row in df.iterrows():
        first_column = df.iat[index, 0]
        if 'tarih' in str(first_column).lower().strip():
            # print('tarih= ', index)
            start_index = index + 1
    
    iter_index = start_index
    while iter_index < len(df.index):
        if isNaN.iat[iter_index, 0]:
            continue
        # print('iterindex= ', iter_index, 'startindex=', start_index)
        date = df.iat[iter_index, 0]
    
        explanation = df.iat[iter_index, 1]
        exp_list = str(explanation).split()
        tc = exp_list[0]
        str1 = " "
        explanation = str1.join(exp_list[1:])
    
        fee = df.iat[iter_index, 3]
        balance = df.iat[iter_index, 4]
        dekont_no = df.iat[iter_index, 5]

        date_list.append(date)
        tc_list.append(tc)
        explanation_list.append(explanation)
        balance_list.append(balance)
        fee_list.append(fee)
        dekont_no_list.append(dekont_no)
    
        iter_index += 1
        
    print('list=>> ', date_list)
    print('list=>> ', tc_list)
    print('list=>> ', balance_list)
    print('list=>> ', fee_list)
    print('list=>> ', dekont_no_list)

    df_list = pd.DataFrame(list(zip(date_list, tc_list, balance_list, fee_list, dekont_no_list, explanation_list)),
               columns =['date', 'tc', 'balance', 'fee', 'dekont', 'aciklama'])
    return df_list



