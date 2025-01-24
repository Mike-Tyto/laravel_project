import sys
import json
import pandas as pd
import matplotlib.pyplot as plt
from io import BytesIO


def plot_weight(data_json):
    # Загрузка данных из JSON
    data = pd.DataFrame(json.loads(data_json))

    # Преобразуем timestamp в datetime
    data['timestamp'] = pd.to_datetime(data['timestamp'])

    # Построение графика
    plt.figure(figsize=(10, 6))
    plt.plot(data['timestamp'], data['value'],
             marker='o', linestyle='-', color='b')
    plt.title('Weight Changes Over Time', fontsize=16)
    plt.xlabel('Timestamp', fontsize=14)
    plt.ylabel('Weight', fontsize=14)
    plt.grid(True)
    plt.tight_layout()

    # Сохранение графика в буфер
    buffer = BytesIO()
    plt.savefig(buffer, format='png', dpi=300)
    buffer.seek(0)

    # Возврат графика как байтового потока
    sys.stdout.buffer.write(buffer.read())


if __name__ == "__main__":
    # Получение JSON-данных из аргументов
    data_json = sys.argv[1]
    plot_weight(data_json)
